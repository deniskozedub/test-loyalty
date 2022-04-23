<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class AccountDTO extends DataTransferObject
{
    public string $phone;

    public string $card;

    public string $email;
}
