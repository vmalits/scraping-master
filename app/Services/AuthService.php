<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    public function register($request): void
    {
        User::create($request);
    }

    /**
     * @param array $credentials
     * @return \Illuminate\Http\JsonResponse
     * @throws ValidationException
     */
    public function login(array $credentials)
    {
        if (!$token = \auth()->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        if (null === auth()->user()->email_verified_at) {
            return response()->json([
                'message' => 'Please verify email!'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->getToken();
    }

    public function getToken()
    {
        return auth()->user()->createToken('personal token')->plainTextToken;
    }
}
