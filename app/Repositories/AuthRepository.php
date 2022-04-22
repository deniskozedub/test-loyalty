<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DataTransferObjects\Auth\AuthDTO;
use App\DataTransferObjects\Auth\LoginDTO;
use App\Models\User;

class AuthRepository extends BaseRepository
{
    public function model(): string
    {
        return User::class;
    }

    public function register(AuthDTO $authDTO): User
    {
        return  $this->query()->create([
            'name' => $authDTO->name,
            'email' => $authDTO->email,
            'password' => $authDTO->password,
        ]);
    }

    public function login(LoginDTO $loginDTO): User
    {
        dd($loginDTO);
    }

    public function findUserByEmail(string $email): ?User
    {
        return $this->query()
                    ->where('email', $email)
                    ->first();
    }
}
