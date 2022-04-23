<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\Transaction\DepositDTO;
use App\Models\LoyaltyPointsRule;
use App\Models\LoyaltyPointsTransaction;
use App\Repositories\AccountRepository;
use App\Repositories\TransactionRepository;

class TransactionService
{
    public function __construct(
        private TransactionRepository $transactionRepository,
        private AccountRepository $accountRepository,
        private LoyaltyPointsRuleService $loyaltyPointsRuleService
    ) {}

    public function getBalance(int $accountId): float
    {
        return $this->transactionRepository->getBalance($accountId);
    }

    /**
     * @throws \Exception
     */
    public function deposit(DepositDTO $depositDTO): LoyaltyPointsTransaction
    {
        $account = $this->accountRepository->findById($depositDTO->accountId);

        if (!$account->active){
            throw  new \Exception('Account is not active', 400);
        }

        $depositDTO->pointsAmount = $this->pointAmount($depositDTO->paymentAmount, $depositDTO->pointsRule);
        $transaction = $this->transactionRepository->create($depositDTO);

        if ($account->email != '' && $account->email_notification){
            //job dispatch
        }

        if ($account->phone != '' && $account->phone_notification) {
            //job dispatch
        }
        return $transaction;
    }

    private function pointAmount(int $paymentAmount, int $pointsRule): int
    {
        $pointsAmount = 0;

        if ($pointsRule = $this->loyaltyPointsRuleService->getById($pointsRule)) {
            $pointsAmount = match ($pointsRule->accrual_type) {
                LoyaltyPointsRule::ACCRUAL_TYPE_RELATIVE_RATE => ($paymentAmount / 100) * $pointsRule->accrual_value,
                LoyaltyPointsRule::ACCRUAL_TYPE_ABSOLUTE_POINTS_AMOUNT => $pointsRule->accrual_value
            };
        }

        return (int) $pointsAmount;
    }

    public function cancel(int $transactionId, string $reason): void
    {
        $this->transactionRepository->cancel($transactionId, $reason);
    }

    /**
     * @throws \Exception
     */
    public function withdraw(int $accountId, int $amount, string $description): LoyaltyPointsTransaction
    {
        $account = $this->accountRepository->findById($accountId);

        if (!$account->active){
            throw  new \Exception('Account is not active', 400);
        }

        if ($this->getBalance($accountId) < $amount){
            throw  new \Exception('Insufficient funds', 400);
        }

        return $this->transactionRepository->withdraw($accountId, $amount, $description);
    }
}
