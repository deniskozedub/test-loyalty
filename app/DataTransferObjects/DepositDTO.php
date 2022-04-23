<?php

declare(strict_types=1);

namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

class DepositDTO extends DataTransferObject
{
    public int $accountId;

    public ?int $pointsRule;

    public float $pointsAmount;

    public string $description;

    public string $paymentId;

    public int $paymentAmount;

    public int $paymentTime;

    public string $accountType;
}
