<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\DepositDTO;
use App\Exceptions\AccountActiveException;
use App\Exceptions\BalanceException;
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
            throw new AccountActiveException();
        }

        $depositDTO->pointsAmount = $this->pointAmount($depositDTO->paymentAmount, $depositDTO->pointsRule);
        $transaction = $this->transactionRepository->create($depositDTO);

        if ($account->email != '' && $account->email_notification){
            //job dispatch send email
        }

        if ($account->phone != '' && $account->phone_notification) {
            //job dispatch send sms
        }
        return $transaction;
    }

    private function pointAmount(int $paymentAmount, int $pointsRule): float
    {
        $pointsAmount = 0;

        if ($pointsRule = $this->loyaltyPointsRuleService->getById($pointsRule)) {
            $pointsAmount = match ($pointsRule->accrual_type) {
                LoyaltyPointsRule::ACCRUAL_TYPE_RELATIVE_RATE => ($paymentAmount / 100) * $pointsRule->accrual_value,
                LoyaltyPointsRule::ACCRUAL_TYPE_ABSOLUTE_POINTS_AMOUNT => $pointsRule->accrual_value
            };
        }

        return (float) $pointsAmount;
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
            throw new AccountActiveException();
        }

        if ($this->getBalance($accountId) < $amount){
            throw  new BalanceException();
        }

        return $this->transactionRepository->withdraw($accountId, $amount, $description);
    }
}
