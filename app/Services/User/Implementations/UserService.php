<?php

namespace App\Services\User\Implementations;

use App\Http\Requests\User\CodeRequest;
use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Repositories\User\Contracts\UserRepositoryInterface;
use App\Services\SMSender\Contracts\SMSenderServiceInterface;
use App\Services\User\Contracts\UserServiceInterface;
use Illuminate\Support\Facades\Cache;

class UserService implements UserServiceInterface
{
    public function __construct(private readonly UserRepositoryInterface $userRepository, private readonly SMSenderServiceInterface $smsSenderService)
    {
    }

    public function sendCode(CodeRequest $request)
    {
        $code = random_int(100000, 999999);
        $phoneNumber = $request->get('phone_number');

        $isSent = $this->smsSenderService->sendCode($phoneNumber, $code);

        Cache::put('sms_code_' . $phoneNumber, $code, now()->addMinutes(10));

        if ($isSent) {
            if (config('sms.driver') === 'fake') {
                return response()->json(['message' => 'Code sent successfully!', 'code' => $code]);
            }
            return response()->json(['message' => 'Code sent successfully!']);
        } else {
            return response()->json(['message' => 'Code not sent!'], 500);
        }
    }

    public function register(StoreUserRequest $request)
    {
        $phoneNumber = $request->input('phone_number');
        $code = $request->input('code');

        $isVerified = $this->verifyCode($phoneNumber, $code);

        if (!$isVerified) {
            return response()->json(['message' => 'Code is not verified!']);
        }

        $user = $this->userRepository->create($request->validated());
        $user->assignRole('customer');

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function login(LoginUserRequest $request)
    {
        $phoneNumber = $request->input('phone_number');
        $code = $request->input('code');

        $isVerified = $this->verifyCode($phoneNumber, $code);

        if (!$isVerified) {
            return response()->json(['message' => 'Code is not verified!!'], 400);
        }

        $user = $this->userRepository->where('phone_number', $request->input('phone_number'))->first();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json(['token' => $token]);
    }

    private function verifyCode($phoneNumber, $code): bool
    {
        if (Cache::has('sms_code_' . $phoneNumber)) {
            $cacheCode = Cache::get('sms_code_' . $phoneNumber);
            if ($cacheCode != $code) {
                return false;
            }
            return true;
        }

        return false;
    }
}
