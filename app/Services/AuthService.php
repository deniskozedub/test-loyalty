<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\Auth\AuthDTO;
use App\DataTransferObjects\Auth\LoginDTO;
use App\Repositories\AuthRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService
{
    public function __construct(private AuthRepository $authRepository) {}

    public function login(LoginDTO $loginDTO): array
    {
        $user = $this->authRepository->findUserByEmail($loginDTO->email);

        if (!$this->checkPassword($loginDTO->password, $user->password)) {
            throw new UnauthorizedHttpException('Bearer', 'Bad credentials');
        }

        return [
            'user' => $user,
            'token' => $user->createToken('apiToken')->plainTextToken
        ];

    }

    public function register(AuthDTO $authDTO): array
    {
        $user = $this->authRepository->register($authDTO);

        return [
            'user' => $user,
            'token' => $user->createToken('apiToken')->plainTextToken
        ];
    }

    public function logout(Request $request): void
    {
        $request->user()->tokens()->delete();
    }

    private function checkPassword(string $inputPassword, string $userPassword): bool
    {
        return Hash::check($inputPassword, $userPassword);
    }
}
