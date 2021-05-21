<?php

namespace App\Http\Controllers;

use App\Mail\AdsEarlyExpire;
use App\Models\Category;
use App\Models\CategoryUser;
use App\Models\Phone;
use App\Models\PhysicalAdress;
use App\Models\Province;
use App\Models\ProvinceUser;
use App\Models\StartDate;
use App\Models\StartDateUser;
use App\Models\User;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
{
    public function index()
    {
        $this->sendNotification();
        return view('dashboard.index');
    }

    public function profil()
    {
        $disponibilities = auth()->user()->startDate;
        $regions = auth()->user()->provinces;
        $categories = auth()->user()->categoryUser;
        $this->sendNotification();
        $planId = auth()->user()->plan_user_id;
        $plan = \App\Models\PlanUser::where('id', '=', $planId)->first();
        return view('dashboard.profil', compact('plan', 'disponibilities', 'categories', 'regions'));
    }

    public function settings()
    {
        $user_categories = auth()->user()->categoryUser;
        $user_disponibilities = auth()->user()->startDate;
        $disponibilities = StartDate::orderBy('id')->get();
        $regions = Province::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        return view('dashboard.edit',
            compact('disponibilities', 'categories', 'regions', 'user_categories', 'user_disponibilities'));
    }

    public function updateUser(Request $request)
    {
        $user = \auth()->user();
        //TODO:check si ca a change
        if ($request->name != $user->getOriginal('name')) {
            $request->validate([
                'name' => ['required', 'string', 'max:255', Rule::unique(User::class)]
            ]);
        } elseif ($request->email != $user->getOriginal('email')) {
            $request->validate([
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ]
            ]);
        } elseif ($request->password && $request->password != $user->getOriginal('password')) {
            $request->validate([
                'password' => [
                    'min:8',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                ],
            ]);
        }
        $request->validate([
            'picture' => ['image:jpg,jpeg,png,svg'],
        ]);
        if ($user->role_id == 2) {
            Validator::make(\request()->all(), [
                'adress' => 'required',
                'phoneone' => 'required',
                'pricemax' => 'max:999999',
                'website' => 'nullable', 'url',
                'websitetwo' => 'nullable', 'url',
                'websitethree' => 'nullable', 'url',
                'description' => 'required', 'max:256',
                'job' => 'required',
                'location' => 'required',
                'locationtwo' => 'not_in:0',
                'locationthree' => 'not_in:0',
                'categoryUser' => 'required|array|max:'.$user->plan_user_id,
                'disponibilites' => [
                    'array|max:7',
                ],
            ])->validate();
        }
        if ($request->surname && $request->surname != $user->getOriginal('surname')) {
            $user->surname = $request->surname;
        }
        if ($request->catchPhrase && $request->catchPhrase != $user->getOriginal('catchPhrase')) {
            $user->catchPhrase = $request->catchPhrase;
        }
        if ($request->possibility_job) {
            $user->possibility_job = $request->possibility_job;
        }
        if ($request->job) {
            $user->job = $request->job;
        }
        if ($request->pricemax) {
            $user->pricemax = $request->pricemax;
        }
        if ($request->description) {
            $user->description = $request->description;
        }
        if ($request->categoryUser) {
            $ct = new CategoryUser();
            $ct->category_id = \request('categoryUser');
            $user->categoryUser()->detach();
            $user->categoryUser()->attach($ct->category_id);
        }
        if ($request->website) {
            $user->website = $request->website;
        }
        if ($request->disponibilities) {
            $di = new startDate();
            $di->start_date_id = \request('disponibilities');
            $user->startDate()->detach();
            $user->startDate()->attach($di->start_date_id);
        }
        if ($request->location) {
            $pro = new ProvinceUser();
            $pro->province_id = \request('location');
            $user->provinces()->detach();
            $user->provinces()->attach($pro->province_id);
        }
        $user->websites()->delete();
        $user->websites()->saveMany([
            new Website(['link' => $request->websitetwo]),
            new Website(['link' => $request->websitethree]),
        ]);
        $user->adresses()->delete();
        $user->adresses()->saveMany([
            new PhysicalAdress(['postal_adress' => $request->adress, 'province_id' => $request->location]),
            new PhysicalAdress(['postal_adress' => $request->adresstwo, 'province_id' => $request->locationtwo]),
            new PhysicalAdress(['postal_adress' => $request->adressthree, 'province_id' => $request->locationthree]),
        ]);
        $user->facebook = $request->facebook;
        $user->twitter = $request->twitter;
        $user->instagram = $request->instagram;
        $user->linkedin = $request->linkedin;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->slug = Str::slug($request->name);

        $user->phones()->delete();
        $user->phones()->saveMany([
            new Phone(['number' => $request->phoneone]),
            new Phone(['number' => $request->phonetwo]),
            new Phone(['number' => $request->phonethree]),
        ]);

        $user->update();
        if ($user->wasChanged()) {
            Session::flash('success-update', 'Votre profil a bien été mis a jour!');
        }
        return redirect(route('dashboard.profil'));

    }

    public function ads()
    {
        return view('dashboard.ads');
    }

    protected function sendNotification()
    {
        foreach (auth()->user()->announcements as $adsExpire) {
            if ($adsExpire->end_plan < Carbon::now()->subDay(1)) {
                if ($adsExpire->sending_time_expire == 0) {
                    $adsExpire->sending_time_expire = 1;
                    $adsExpire->update();
                    Mail::to(auth()->user()->email)
                        ->send(new AdsEarlyExpire($adsExpire));
                    Session::flash('expire', 'Attention, une de vos annonce va expirer dans un jour !');
                }
            }
            if ($adsExpire->end_plan <= Carbon::now()) {
                $adsExpire->is_payed = 0;
                $adsExpire->end_plan = null;
                $adsExpire->plan_announcement_id = null;
                $adsExpire->update();
            }
        }
        if (auth()->user()->end_plan < Carbon::now()->subDay(1)) {
            if (auth()->user()->sending_time_expire == 0) {
                auth()->user()->sending_time_expire = 1;
                auth()->user()->end_plan = null;
                auth()->user()->save();
                Mail::to(env('MAIL_FROM_ADDRESS'))
                    ->send(new AdsEarlyExpire(auth()->user()));
                Session::flash('expire', 'Attention, votre compte va expirer dans un jour !');
            }
        }
        if (auth()->user()->end_plan <= Carbon::now()) {
            auth()->user()->is_payed = 0;
            auth()->user()->end_plan = null;
            auth()->user()->plan_user_id = null;
            auth()->user()->update();
        }
        //TODO : supprimer l'annonce non payer 3j apres
    }
}
