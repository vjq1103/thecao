<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckOtpRule implements Rule
{
    private $otp;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($otp)
    {
        $this->otp = $otp;
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
        return $value == $this->otp;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Mã OTP không đúng';
    }
}
