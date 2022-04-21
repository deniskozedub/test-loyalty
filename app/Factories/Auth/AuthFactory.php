<?php

declare(strict_types=1);

namespace App\Factories\Auth;

use App\DataTransferObjects\Auth\AuthDTO;
use App\DataTransferObjects\Auth\LoginDTO;
use App\Http\Requests\User\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AuthFactory
{
    /**
     * @throws UnknownProperties
     */
    public function register(RegisterRequest $registerRequest): AuthDTO
    {
        return new AuthDTO([
            'name' => $registerRequest->input('name'),
            'email' => $registerRequest->input('email'),
            'password' => Hash::make($registerRequest->input('password'))
        ]);
    }

    public function login(string $email, string $password): LoginDTO
    {
        return new LoginDTO([
            'email' => $email,
            'password' => $password
        ]);
    }
}
