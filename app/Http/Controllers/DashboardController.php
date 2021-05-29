<?php
namespace App\Http\Controllers;

use App\Mail\AdsEarlyExpire;
use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use App\Models\Category;
use App\Models\CategoryUser;
use App\Models\Message;
use App\Models\Phone;
use App\Models\PhysicalAdress;
use App\Models\Province;
use App\Models\ProvinceUser;
use App\Models\StartDate;
use App\Models\StartMonth;
use App\Models\User;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class DashboardController extends Controller
{
    public function index()
    {
        $this->sendExpireNotificationAccount();
        $messages = Message::where('to_id', '=', \auth()->user()->id)->with('user')->orderBy('created_at',
            'DESC')->take(3)->get();
        $lastAnnouncements = Announcement::where('user_id', '=',
            \auth()->user()->id)->WithLikes()->NoBan()->Payement()->Published()->orderBy('view_count',
            'DESC')->orderBy('created_at', 'DESC')->take(3)->get();
        $notifications = tap(\auth()->user()->unreadNotifications)->markAsRead();

        return view('dashboard.index', compact('notifications', 'lastAnnouncements', 'messages'));
    }

    public function profil()
    {
        $this->sendExpireNotificationAccount();
        $disponibilities = auth()->user()->startDate;
        $regions = auth()->user()->provinces;
        $categories = auth()->user()->categoryUser;
        $this->sendExpireNotificationAccount();
        $planId = auth()->user()->plan_user_id;
        $plan = \App\Models\PlanUser::where('id', '=', $planId)->first();
        return view('dashboard.profil', compact('plan', 'disponibilities', 'categories', 'regions'));
    }

    public function settings()
    {
        $this->sendExpireNotificationAccount();
        $user_categories = auth()->user()->categoryUser;
        $user_disponibilities = auth()->user()->startDate;
        $disponibilities = StartDate::orderBy('id')->get();
        $regions = Province::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        return view('dashboard.edit',
            compact('disponibilities', 'categories', 'regions', 'user_categories', 'user_disponibilities'));
    }

    public function show(Announcement $announcement)
    {
        $this->sendExpireNotificationAds();
        $this->sendExpireNotificationAccount();
        $firstAd = Auth::user()->announcements()->NotDraft()->firstOrFail();
        $user = User::where('id', '=', \auth()->user()->id)->with('announcements')->firstOrFail();
        $announcement = Announcement::withLikes()->where('id', '=', $announcement->id)->firstOrFail();
        return view('dashboard.show', compact('announcement', 'user', 'firstAd'));
    }

    public function showDraft(Announcement $announcement)
    {
        $this->sendExpireNotificationAds();
        $this->sendExpireNotificationAccount();
        $firstAdDraft = Auth::user()->announcements()->Draft()->firstOrFail();
        $user = User::where('id', '=', \auth()->user()->id)->with('announcements')->firstOrFail();
        $announcement = Announcement::withLikes()->where('id', '=', $announcement->id)->firstOrFail();
        return view('dashboard.draftAd', compact('announcement', 'user', 'firstAdDraft'));
    }

    public function editAdsDraft(Announcement $announcement)
    {
        $this->sendExpireNotificationAds();
        $this->sendExpireNotificationAccount();
        $firstAdDraft = Auth::user()->announcements()->first();
        $user = User::where('id', '=', \auth()->user()->id)->with('announcements')->first();
        $announcement = Announcement::withLikes()->where('slug', '=', $announcement->slug)->first();
        $plan = $announcement->plan_announcement_id;
        $categories = Category::all();
        $regions = Province::all();
        $disponibilities = StartMonth::all();
        $announcement_categories = $announcement->categoryAds;
        $announcement_disponibilities = $announcement->startMonth;
        return view('dashboard.updateAdsDraft',
            compact('announcement', 'categories', 'regions', 'plan', 'disponibilities', 'user', 'firstAdDraft',
                'announcement_categories', 'announcement_disponibilities'));
    }

    public function updateUser(Request $request)
    {
        $this->sendExpireNotificationAccount();
        $user = \auth()->user();
        $request->validate([
            'name' => 'sometimes|required|string|max:255', Rule::unique('users')->ignore($user->id),
            'surname' => 'sometimes|string|max:255',
            'email' => 'sometimes|required|string|max:255', Rule::unique('users')->ignore($user->id),
            'picture' => ['sometimes,image:jpg,jpeg,png,svg'],
        ]);
        if ($request->password && $request->password != $user->getOriginal('password')) {
            $request->validate([
                'password' => [
                    'min:8',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                ],
            ]);
            $user->password = Hash::make($request->password);
        }
        if ($request->picture != $user->getOriginal('picture')) {
            Storage::makeDirectory('users');
            $filename = request('picture')->hashName();
            $pic = Image::make(\request()->file('picture'))->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path('users/'.$filename));
            $user->picture = 'users/'.$filename;
        }
        if ($user->role_id == 2) {
            Validator::make(\request()->all(), [
                'adress' => 'sometimes|required',
                'number' => 'sometimes|required',
                'pricemax' => 'sometimes|max:999999',
                'website' => 'sometimes|nullable', 'url',
                'websitetwo' => 'sometimes|nullable', 'url',
                'websitethree' => 'sometimes|nullable', 'url',
                'description' => 'sometimes|required', 'max:256',
                'job' => 'sometimes|required',
                'location' => 'sometimes|required',
                'locationtwo' => 'sometimes|not_in:0',
                'locationthree' => 'sometimes|not_in:0',
                'categoryUser' => 'sometimes|required|array|max:'.$user->plan_user_id,
                'disponibilites' => [
                    'sometimes|array|max:7',
                ],
            ])->validate();
        }
        $user->surname = $request->surname;
        $user->catchPhrase = $request->catchPhrase;
        $user->possibility_job = $request->possibility_job;
        $user->job = $request->job;
        $user->pricemax = $request->pricemax;
        $user->description = $request->description;
        $ct = new CategoryUser();
        $ct->category_id = \request('categoryUser');
        $user->categoryUser()->detach();
        $user->categoryUser()->attach($ct->category_id);
        $user->website = $request->website;
        $di = new startDate();
        $di->start_date_id = \request('disponibilities');
        $user->startDate()->detach();
        $user->startDate()->attach($di->start_date_id);
        $pro = new ProvinceUser();
        $pro->province_id = \request('location');
        $user->provinces()->detach();
        $user->provinces()->attach($pro->province_id);
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
            new Phone(['number' => $request->number]),
            new Phone(['number' => $request->phonetwo]),
            new Phone(['number' => $request->phonethree]),
        ]);

        $user->update();
        if ($user->wasChanged()) {
            Session::flash('success-update', 'Votre profil a bien été mis a jour!');
        } else {
            Session::flash('success-update-not', 'Rien n\'a été changé');
        }
        return redirect(route('dashboard.profil'));

    }

    public function editAds(Announcement $announcement)
    {
        $this->sendExpireNotificationAds();
        $this->sendExpireNotificationAccount();
        $plan = $announcement->plan_announcement_id;
        $categories = Category::all();
        $regions = Province::all();
        $disponibilities = StartMonth::all();
        $announcement_categories = $announcement->categoryAds;
        $announcement_disponibilities = $announcement->startMonth;
        return view('dashboard.updateAds', compact('announcement', 'categories', 'regions', 'plan', 'disponibilities',
                'announcement_categories', 'announcement_disponibilities'));
    }


    public function updateAds(Announcement $announcement, Request $request)
    {
        $this->sendExpireNotificationAds();
        $this->sendExpireNotificationAccount();
        $request->validate([
            'title' => 'sometimes|required', Rule::unique('announcements')->ignore($announcement->id),
            'description' => 'sometimes|max:256|required',
            'job' => 'sometimes|max:256|required',
            'location' => 'sometimes|not_in:0|required',
            'startmonth' => 'sometimes|required',
            'categoryAds' => 'sometimes|array|required|max:'.$announcement->plan_announcement_id
        ]);
        if ($request->has('publish')) {
            if ($announcement->plan_announcement_id == 2 || $announcement->plan_announcement_id == 3) {
                $publish = true;
                $ad = $announcement->id;
                $planAd = $announcement->plan_announcement_id;
                $announcement = Announcement::where('id', '=', $ad)->first();
                return \redirect(route('announcements.payed', compact('publish', 'announcement', 'planAd')));
            } else {
                $announcement->is_draft = 0;
                $announcement->is_payed = 1;
                $announcement->end_plan = Carbon::now()->addDays(7)->addHours(2);
                $announcement->update();
                Session::flash('success-update', 'Votre annonce a bien été publié!');
                return \redirect(route('dashboard.ads'));
            }
        }
        $announcement = Announcement::withLikes()->where('slug', '=', $announcement->slug)->first();
        $announcement->title = $request->title;
        $announcement->description = $request->description;
        $announcement->job = $request->job;
        $announcement->province_id = $request->location;
        $announcement->pricemax = $request->price_max;
        $announcement->start_month_id = $request->startmonth;
        $ct = new AnnouncementCategory();
        $ct->category_id = \request('categoryAds');
        $announcement->categoryAds()->detach();
        $announcement->categoryAds()->attach($ct->category_id);
        if ($request->picture && $request->picture != $announcement->getOriginal('picture')) {
            Storage::makeDirectory('ads');
            $filename = request('picture')->hashName();
            $img = Image::make($request->file('picture'))->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path('ads/'.$filename));
            $announcement->picture = 'ads/'.$filename;
        }
        $announcement->plan_announcement_id = $announcement->getOriginal('plan_announcement_id');
        $announcement->update();
        if ($announcement->wasChanged()) {
            Session::flash('success-update', 'Votre annonce a bien été mis a jour!');
        } else {
            Session::flash('success-update-not', 'Rien n\'a été changé');
        }
        if (url("dashboard/ads/draft/{$announcement->slug}")){
            return redirect('dashboard/ads/draft/'.$announcement->slug);
        }else{
            return redirect('dashboard/ads/'.$announcement->slug);
        }
    }

    public function deleteAds(Announcement $announcement)
    {
        Announcement::where('id', '=', $announcement->id)->delete();
        return Redirect::route('dashboard.ads')->with('success-delete', 'Annonce supprimée !');
    }

    public function ads(Announcement $announcement)
    {
        $this->sendExpireNotificationAccount();
        $firstAd = Auth::user()->announcements()->NotDraft()->first();
        $firstAdDraft = Auth::user()->announcements()->Draft()->first();
        return view('dashboard.ads', compact('firstAd', 'firstAdDraft'));
    }

    protected function sendExpireNotificationAccount()
    {
        if (auth()->user()->end_plan < Carbon::now()->addHours(2)->subDays(1)) {
            if (auth()->user()->sending_time_expire == 0) {
                auth()->user()->sending_time_expire = 1;
                auth()->user()->end_plan = null;
                auth()->user()->plan_user_id = null;
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
    }

    protected function sendExpireNotificationAds()
    {
        foreach (auth()->user()->announcements as $adsExpire) {
            if ($adsExpire->end_plan < Carbon::now()->subDay(1)->addHours(2)) {
                if ($adsExpire->sending_time_expire == 0) {
                    $adsExpire->sending_time_expire = 1;
                    $adsExpire->update();
                    Mail::to(auth()->user()->email)
                        ->send(new AdsEarlyExpire($adsExpire));
                    Session::flash('expire', 'Attention, une de vos annonce va expirer dans un jour !');
                }
            }
            if ($adsExpire->end_plan <= Carbon::now()->addHours(2)) {
                $adsExpire->is_payed = 0;
                $adsExpire->end_plan = null;
                $adsExpire->plan_announcement_id = null;
                $adsExpire->update();
            }
        }
    }
}
