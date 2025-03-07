<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use App\Rules\NewOldPasswordNotSame;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        
        Validator::make($input, [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string'],
            'password_confirmation' => ['required', 'string', 'confirmed'],
        ],
        ['password_confirmation.confirmed' => 'The Confirm Password does not match with new password'])->after(function ($validator) use ($user, $input) {

            if($input['current_password'] == $input['password']){
                $validator->errors()->add('password', __('Current Password and New Password should not be the same'));
            }
            if (! isset($input['current_password']) || ! Hash::check($input['current_password'], $user->password)) {
                $validator->errors()->add('current_password', __('The provided password does not match your current password.'));
            }
        })->validateWithBag('updatePassword');

        $user->forceFill([
            'password' => $input['password'],//Hash::make($input['password']),
        ])->save();
    }
}
