<?php

namespace App\Models\Users\Traits;

trait PhoneVerificationTrait
{
    public function phoneIsVerified()
    {
        return !is_null($this->phone_verified_at);
    }
}
