<?php

namespace App\Actions\Fortify;

use App\Mail\NewUser;
use App\Mail\NewUserAdmin;
use App\Models\CategoryUser;
use App\Models\Phone;
use App\Models\PhysicalAdress;
use App\Models\ProvinceUser;
use App\Models\StartDate;
use App\Models\User;
use App\Models\Website;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;


    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return string
     */
    public function create(array $input)
    {
        $type = \request('type');
        Session::put('type', $type);
        $plan = \request('plan');
        Session::put('plan', $plan);

        if (request()->plan_user_id == 1) {
            $payed = 1;
        } else {
            $payed = 0;
        }
        if (request('picture')) {
            $pic = $input['picture'];
        } else {
            $pic = null;
        }

        if ($type == 'user') {

            Validator::make($input, [
                'name' => ['required', 'string', 'max:255', Rule::unique(User::class)],
                'picture' => 'image', 'mimes:jpeg,png,jpg', 'max:2048',
                'conditions' => 'required',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'number' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:10','max:12'],
                'password' => [
                    'required',
                    'min:8',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                ],
            ])->validate();
            $user = User::create([
                'name' => $input['name'],
                'surname' => $input['surname'],
                'email' => $input['email'],
                'picture' => $pic,
                'role_id' => $input['role_id'],
                'plan_user_id' => $input['plan_user_id'],
                'conditions' => $input['conditions'],
                'is_payed' => $payed,
                'slug' => Str::slug($input['name']),
                'password' => Hash::make($input['password']),
            ]);
            if ($user->plan_user_id == 1) {
                $trial = Carbon::now()->addDays(7)->addHours(2);
                $user->end_plan = $trial;
            }
        }
        if (\request('type') == 'company') {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255', Rule::unique(User::class)],
                'picture' => 'image', 'mimes:jpeg,png,jpg', 'max:2048',
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'adress' => 'required',
                'website' => 'nullable', 'url',
                'description' => 'required', 'max:256',
                'conditions' => 'required',
                'job' => 'required',
                'number' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:7','max:14'],
                'location' => 'required|not_in:0',
                'categoryUser' => 'required|array|max:'.$input['plan_user_id'],
                'disponibilites' => [
                    'array|max:7',
                ],
                'password' => [
                    'required',
                    'min:8',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                ],
            ])->validate();
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'picture' => $pic,
                'conditions' => $input['conditions'],
                'role_id' => $input['role_id'],
                'plan_user_id' => $input['plan_user_id'],
                'website' => $input['website'],
                'job' => $input['job'],
                'is_payed' => $payed,
                'pricemax' => $input['pricemax'],
                'slug' => Str::slug($input['name']),
                'description' => $input['description'],
                'password' => Hash::make($input['password']),
            ]);
            $pro = new ProvinceUser();
            $pro->province_id = \request('location');
            $phy = new PhysicalAdress(
                [
                    'province_id' => \request('location'),
                    'postal_adress' => \request('adress')
                ]
            );
            $user->possibility_job = \request('possibility_job');
            $user->catchPhrase = \request('catchPhrase');
            $user->adresses()->save($phy);
            $user->provinces()->attach($pro->province_id);
            $ct = new CategoryUser();
            $ct->category_id = \request('categoryUser');
            $user->categoryUser()->attach($ct->category_id);
            $di = new StartDate();
            $di->start_date_id = \request('disponibilities');
            $user->startDate()->attach($di->start_date_id);
            if ($user->plan_user_id == 1) {
                $trial = Carbon::now()->addDays(7)->addHours(2);
                $user->end_plan = $trial;
            }
        }
        if (\request('picture')) {
            Storage::makeDirectory('users');
            $filename = request('picture')->hashName();
            $pic = Image::make(\request()->file('picture'))->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(public_path('users/'.$filename));
            $user->picture = 'users/'.$filename;
        } else {
            $pic = null;
        }
        $phone = new Phone(['number' => $input['number']]);
        $user->phones()->save($phone);
        if (request()->newslettersignin === 1) {
            Newsletter::subscribe(request()->newsletter);
        }
        $user->plan_user_id = request('plan_user_id');
        $user->save();
        Session::forget('type');
        Session::forget('plan');
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->send(new NewUserAdmin($user));
        Mail::to($user->email)
            ->send(new NewUser($user));
        Session::flash('success-inscription', 'Votre inscription à été un succés !');
        return $user;
    }
}
