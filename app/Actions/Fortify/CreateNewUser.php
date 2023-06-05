<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users', 'not_regex:/\bmailinator\.com\b/i'],
            'password' => $this->passwordRules(),
            'g-recaptcha-response' => 'required|captcha',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ],[
            'g-recaptcha-response' => 'Please complete the reCAPTCHA verification.',
        ])->validate();


        return User::create([
            'name' => $this->userName(),
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }

    /**
     * userName
     *
     * @return string
     */

    public function userName(): string
    {
        $count = User::all()->count() + 1;
        $username = "TinyMember$count";
        return $username;
    }
}
