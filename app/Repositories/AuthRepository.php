<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DataTransferObjects\Auth\RegisterDTO;
use App\Models\User;

class AuthRepository extends BaseRepository
{
    public function model(): string
    {
        return User::class;
    }

    public function register(RegisterDTO $registerDTO): User
    {
        return  $this->query()->create([
            'name' => $registerDTO->name,
            'email' => $registerDTO->email,
            'password' => $registerDTO->password,
        ]);
    }

    public function findUserByEmail(string $email): ?User
    {
        return $this->query()
                    ->where('email', $email)
                    ->first();
    }
}
