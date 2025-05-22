<?php

namespace App\Services\SMSender\Contracts;

use App\Http\Requests\User\CodeRequest;

interface SMSenderServiceInterface
{
    public function sendCode(string $phone_number, string $code);
}
