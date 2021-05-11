<?php

namespace App\Actions\Fortify;

use App\Models\CategoryUser;
use App\Models\Phone;
use App\Models\startDate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
            'name' => ['required', 'string', 'max:255'],
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
            $description = $input['description'];
        } else {
            $description = null;
        }
        if (request('pricemax')) {
            $pricemax = $input['pricemax'];
        } else {
            $pricemax = null;
        }
        if (request()->plan_user_id) {
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
        if (request()->hasFile('picture')) {
            $filename = request('picture')->hashName();
            $img = Image::make(request()->file('picture'))->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(storage_path('app/public/users/'.$filename));
            $user->picture = 'users/'.$filename;
        } else {
            $pic = null;
        }
        $phone = new Phone(['number' => $input['phone']]);
        $ct = new CategoryUser();
        $ct->category_id = \request('category_job');
        $di = new startDate();
        $di->start_date_id = \request('disponibilities');
        $user->phones()->save($phone);
        //$user->categoryUser()->limit(2);
        $user->categoryUser()->attach($ct->category_id);
        $user->startDate()->attach($di->start_date_id);
        if (request()->plan_user_id = 1) {
            Session::flash('success-inscription',
                'Votre inscription sera opérationnelle après approbation de l\'administrateur !');
        }
        return $user;
    }
}
