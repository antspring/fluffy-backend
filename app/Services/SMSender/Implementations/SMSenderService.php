<?php

namespace App\Services\SMSender\Implementations;

use App\Services\SMSender\Contracts\SMSenderServiceInterface;
use SmsAero\SmsAeroMessage;

class SMSenderService implements SMSenderServiceInterface
{

    public function sendCode($phone_number, $code)
    {
        $smsAeroMessage = new SmsAeroMessage(env('SMS_LOGIN'), env('SMS_API_KEY'));

        $response = $smsAeroMessage->send(['number' => $phone_number, 'text' => 'Код для аутентификации: ' . $code, 'sign' => 'SMS Aero']);

        return $response['success'];
    }
}
