<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\AccountDTO;
use App\Exceptions\AccountException;
use App\Jobs\AccountActionJob;
use App\Models\LoyaltyAccount;
use App\Repositories\AccountRepository;

class AccountService
{
    public function __construct(
        private AccountRepository $accountRepository,
        private TransactionService $transactionService
    ){}

    public function create(AccountDTO $DTO): ?LoyaltyAccount
    {
        return $this->accountRepository->create($DTO);
    }

    public function activate(int $id): void
    {
        $account =  $this->accountRepository->changeStatus($id);
        AccountActionJob::dispatch($account);
    }

    /**
     * @throws AccountException
     */
    public function getBalance(int $accountId): float
    {
        if (!$this->accountRepository->accountExists($accountId)){
            throw new AccountException();
        }

        return $this->transactionService->getBalance($accountId);
    }
}
