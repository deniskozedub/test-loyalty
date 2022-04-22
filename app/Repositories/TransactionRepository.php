<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\LoyaltyPointsTransaction;

class TransactionRepository extends BaseRepository
{
    public function model(): string
    {
        return LoyaltyPointsTransaction::class;
    }

    public function getBalance(int $accountId): float
    {
        return  (floatval($this->query()
                     ->where('canceled', '=', 0)
                     ->where('account_id', $accountId)
                     ->sum('points_amount')));
    }
}
