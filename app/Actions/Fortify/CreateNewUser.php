<?php

namespace App\Actions\Fortify;

use App\Http\Controllers\MailController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use PhpOffice\PhpSpreadsheet\Worksheet\Validations;

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
            'firstName' => ['required', 'string', 'max:15'],
            'lastName' => ['required', 'string', 'max:15'],
            'birthDate' => ['required', 'date'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
            'phone' => ['required', 'string', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ],[
            'email.unique' => __('Validation.custom.email.unique'),
            'phone.unique' => __('Validation.custom.phone.unique')
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
            'phone' => $input['phone'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
