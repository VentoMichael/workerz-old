<?php

namespace App\Actions\Fortify;

use App\Models\Phone;
use App\Models\PlanUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return User|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(array $input)
    {
        //dd(request()->all());

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
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
        if (request('adress')) {
            $adress = $input['adress'];
        } else {
            $adress = null;
        }
        $user = User::create([
            'name' => $input['name'],
            'surname' => $input['surname'],
            'email' => $input['email'],
            'picture' => $pic,
            'role_id' => $input['role_id'],
            'plan_user_id' => $input['plan_user_id'],
            'website' => $web,
            //'disponibilities' => $input['disponibilities'],
            //'province_id' => $input['location'],
            //'category-job' => $input['category-job[]'],
            'job' => $job,
            'postal_adress' => $adress,
            'pricemax' => $pricemax,
            'description' => $description,
            'password' => Hash::make($input['password']),
        ]);

        $ids = User::latest()->first('id');
        foreach ($ids as $id) {

        }
        $phone = Phone::create([
            'number' => $input['phone'],
            'user_id' => $id
        ]);
        $user->phones()->save($phone);
        Session::flash('success-inscription', 'Votre inscription à été un succés !');
        if (!isset($_POST['plan_user_id'])) {
            return view('users.plans');
        } else {
            return $user;
        }
    }
}
