<?php

namespace App\Rules;

use Dotenv\Validator;
use Illuminate\Contracts\Validation\Rule;

class PasswordResetRules implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('Auth');
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function validatePassword(array $data)
    {
        $messages = [
            'old_password.required' => 'Please enter the old password',
            'password.required' => 'Please enter a new password',
            'password.min' => 'Password length must not be less then 8 character',
            'c-password.same' => 'New password must match with confirm password',
        ];
        $validator = Validator::make($data, [
            'old_password' => ['required'],
            'password' => ['required', 'min:8'],
            'c-password' => ['same:password'],
        ], $messages);
        return $validator;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
