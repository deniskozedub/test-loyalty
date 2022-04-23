<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DataTransferObjects\DepositDTO;
use App\Models\LoyaltyPointsTransaction;

class TransactionRepository extends BaseRepository
{
    public function model(): string
    {
        return LoyaltyPointsTransaction::class;
    }

    public function getBalance(int $accountId): float
    {
        return (float)$this->query()
                           ->where('canceled', '=', 0)
                           ->where('account_id', $accountId)
                           ->sum('points_amount');
    }

    public function create(DepositDTO $depositDTO): LoyaltyPointsTransaction
    {
        return $this->query()
                    ->create([
                        'account_id' => $depositDTO->accountId,
                        'points_rule' => $depositDTO->pointsRule,
                        'points_amount' => $depositDTO->pointsAmount,
                        'description' => $depositDTO->description,
                        'payment_id' => $depositDTO->paymentId,
                        'payment_amount' => $depositDTO->paymentAmount,
                        'payment_time' => $depositDTO->paymentTime,
                    ]);
    }

    public function cancel(int $transactionId, string $reason): void
    {
        $transaction =  $this->query()
                             ->where('id', $transactionId)
                             ->where('canceled', 0)
                             ->firstOrFail();

        $transaction->canceled = time();
        $transaction->cancellation_reason = $reason;
        $transaction->save();
    }

    public function withdraw(int $accountId, int $amount, string $description): LoyaltyPointsTransaction
    {
        return $this->query()
                    ->create([
                        'account_id' => $accountId,
                        'points_rule' => 'withdraw',
                        'points_amount' => -$amount,
                        'description' => $description,
                    ]);
    }
}
