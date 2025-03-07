<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MultipleEmails implements Rule
{
    public function passes($attribute, $value)
    {
        $emails = preg_split('/[,\s]+/', $value);

        foreach ($emails as $email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'Invalid email format. Please use comma or space to separate multiple valid email addresses.';
    }
}
