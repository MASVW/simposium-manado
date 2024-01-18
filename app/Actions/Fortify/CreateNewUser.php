<?php

namespace App\Actions\Fortify;

use App\Http\Controllers\MailController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $mail = new MailController();
        Validator::make($input, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'birthDate' => ['required', 'date', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        
        $firstName = $input['firstName'];
        $lastName = $input['lastName'];
        $email = $input['email'];
        $mail->register($firstName, $lastName, $email);

        return User::create([
            'firstName' => $firstName,
            'lastName' => $lastName,
            'birthDate' => $input['birthDate'],
            'email' => $email,
            'password' => Hash::make($input['password']),
        ]);
    }
}
