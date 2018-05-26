<?php

namespace App\Rules;

use App\Admin;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class ValidUsernameEmail implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (str_contains($value, '@')) {
            $user = User::where('email', $value)->first();

            return $user != null;
        }

        $admin = Admin::where('username', $value)->first();

        return $admin != null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The given email / username is not valid.';
    }
}
