<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Service\Twilio\PhoneNumberLookupService;

class PhoneNumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $service;
    public function __construct(PhoneNumberLookupService $phoneNumberLookupService)
    {
        $this->service = $phoneNumberLookupService;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $this->service->validate($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The phone number has to be in either national or international format.';
    }
}
