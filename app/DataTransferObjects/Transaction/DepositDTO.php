<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Transaction;

use Spatie\DataTransferObject\DataTransferObject;

class DepositDTO extends DataTransferObject
{
    public int $accountId;

    public ?int $pointsRule;

    public int $pointsAmount;

    public string $description;

    public string $paymentId;

    public int $paymentAmount;

    public int $paymentTime;

    public string $accountType;
}
