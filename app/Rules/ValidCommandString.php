<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidCommandString implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return is_string($value) && !empty($value) && empty(str_replace(['L', 'R', 'B', 'F'], '', $value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The command string must only contain the letters L, R, B and F';
    }
}
