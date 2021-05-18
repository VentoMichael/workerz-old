<?php

namespace App\Actions\Fortify;

use App\Mail\AdsCreated;
use App\Mail\AdsCreatedUser;
use App\Mail\NewUser;
use App\Mail\NewUserAdmin;
use App\Models\CategoryUser;
use App\Models\Phone;
use App\Models\PhysicalAdress;
use App\Models\ProvinceUser;
use App\Models\startDate;
use App\Models\User;
use http\Env\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255', Rule::unique(User::class)],
            'picture' => ['image:jpg,jpeg,png,svg'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => [
                'required',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
        ])->validate();

        if (request('picture')) {
            $pic = $input['picture'];
        } else {
            $pic = null;
        }
        if (request('surname')) {
            $sur = $input['surname'];
        } else {
            $sur = null;
        }
        if (request('website')) {
            Validator::make($input, [
                'website' => ['url'],
            ])->validate();
            $web = $input['website'];
        } else {
            $web = null;
        }
        if (request('job')) {
            $job = $input['job'];
        } else {
            $job = null;
        }
        if (request('pricemax')) {
            $pricemax = $input['pricemax'];
        } else {
            $pricemax = null;
        }
        if (request('description')) {
            Validator::make($input, [
                'description' => ['max:256'],
            ])->validate();
            $description = $input['description'];
        } else {
            $description = null;
        }
        if (request('pricemax')) {
            $pricemax = $input['pricemax'];
        } else {
            $pricemax = null;
        }
        if (request()->plan_user_id == 1) {
            $payed = 1;
        } else {
            $payed = 0;
        }
        $user = User::create([
            'name' => $input['name'],
            'surname' => $sur,
            'email' => $input['email'],
            'picture' => $pic,
            'role_id' => $input['role_id'],
            'plan_user_id' => $input['plan_user_id'],
            'website' => $web,
            'job' => $job,
            'is_payed' => $payed,
            'pricemax' => $pricemax,
            'slug' => Str::slug($input['name']),
            'description' => $description,
            'password' => Hash::make($input['password']),
        ]);
        if (\request('picture')) {
            Storage::makeDirectory('users');
            $filename = request('picture')->hashName();
            $pic = Image::make(\request()->file('picture'))->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(storage_path('app/public/users/'.$filename));
            $user->picture = 'users/'.$filename;
        } else {
            $pic = null;
        }
        if (\request('location')) {
            $pro = new ProvinceUser();
            $pro->province_id = \request('location');
            $phy = new PhysicalAdress(['province_id' => \request('location'), 'postal_adress' => \request('adress')]);
            $user->adresses()->save($phy);
            $user->provinces()->attach($pro->province_id);
        }
        if (\request('category_job')) {
            $ct = new CategoryUser();
            $ct->category_id = \request('category_job');
            $di = new startDate();
            $di->start_date_id = \request('disponibilities');
            $user->categoryUser()->attach($ct->category_id);
        }
        if (\request('disponibilities')) {
            $ct = new CategoryUser();
            $ct->category_id = \request('disponibilities');
            $user->startDate()->attach($di->start_date_id);
        }

        $phone = new Phone(['number' => $input['phone']]);
        $user->phones()->save($phone);
        $user->plan_user_id = request('plan_user_id');
        $user->save();
        Mail::to(env('MAIL_FROM_ADDRESS'))
            ->send(new NewUserAdmin($user));
        Mail::to($user->email)
            ->send(new NewUser($user));
        Session::flash('success-inscription', 'Votre inscription à été un succés !');
        return $user;
    }
}
