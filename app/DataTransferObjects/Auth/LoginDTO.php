<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Auth;

use Spatie\DataTransferObject\DataTransferObject;

class LoginDTO extends DataTransferObject
{
    public string $email;

    public string $password;
}
