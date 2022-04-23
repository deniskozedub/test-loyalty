<?php

declare(strict_types=1);

namespace App\Factories;

use App\DataTransferObjects\AccountDTO;
use App\Http\Requests\AccountRequest;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class AccountFactory
{
    /**
     * @throws UnknownProperties
     */
    public function create(AccountRequest $accountRequest): AccountDTO
    {
        return new AccountDTO([
            'phone' => $accountRequest->input('phone'),
            'email' => $accountRequest->input('email'),
            'card' => $accountRequest->input('card')
        ]);
    }
}
