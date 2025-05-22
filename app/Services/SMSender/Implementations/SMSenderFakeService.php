<?php

namespace App\Services\SMSender\Implementations;

use App\Services\SMSender\Contracts\SMSenderServiceInterface;

class SMSenderFakeService implements SMSenderServiceInterface
{

    public function sendCode(string $phone_number, string $code)
    {
        return true;
    }
}
