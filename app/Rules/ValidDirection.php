<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidDirection implements Rule
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
        return in_array(strtoupper($value), config('rovers.directions'));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $directions = implode(", ", config('rovers.directions'));

        return sprintf(
            'Please provide a valid direction from the following selection: %s.',
            $directions
        );
    }
}
