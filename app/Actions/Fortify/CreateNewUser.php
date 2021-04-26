<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
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
                'regex:/[A-Z]/'
            ],
        ])->validate();
        $user = User::create([
            'name' => $input['name'],
            'surname' => $input['surname'],
            'email' => $input['email'],
            'picture' => $input['picture'],
            'role_id' => $input['role_id'],
            //'phone' => $input['phone'],
            //'adress' => $input['adress'],
            //'website' => $input['website'],
            //'disponibilities' => $input['disponibilities[]'],
            //'location' => $input['location[]'],
            //'category-job' => $input['category-job[]'],
            //'job' => $input['job'],
            //'price-h' => $input['price-h'],
            //'description' => $input['description'],
            'password' => Hash::make($input['password']),
        ]);
        Session::flash('success-inscription', 'Here is your success message');
        return $user;
    }
}
