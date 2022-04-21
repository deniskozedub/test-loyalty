<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Auth;

use Spatie\DataTransferObject\DataTransferObject;

class AuthDTO extends DataTransferObject
{
    public string $name;

    public string $email;

    public string $password;
}
