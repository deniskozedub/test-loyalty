<?php

declare(strict_types=1);

namespace App\Factories;

use App\DataTransferObjects\Transaction\DepositDTO;
use App\Http\Requests\Transaction\LoyaltyPointRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class TransactionFactory
{
    /**
     * @throws UnknownProperties
     */
    public function deposit(LoyaltyPointRequest $pointRequest): DepositDTO
    {
        return new DepositDTO([
            'accountId' => $pointRequest->input('accountId'),
            'pointsRule' => $pointRequest->input('pointsRule'),
            'pointsAmount' => $pointRequest->input('pointsAmount'),
            'description' => $pointRequest->input('description'),
            'paymentId' => $pointRequest->input('paymentId'),
            'paymentAmount' => $pointRequest->input('paymentAmount'),
            'paymentTime' => $pointRequest->input('paymentTime'),
            'accountType' => $pointRequest->input('accountType'),
        ]);
    }
}
