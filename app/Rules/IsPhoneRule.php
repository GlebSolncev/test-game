<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 *
 */
class IsPhoneRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(strlen($value) > 13){
            return false;
        }

        $phone = str_replace('+','', $value);
        return $phone;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'phone is uncurrect';
    }
}
