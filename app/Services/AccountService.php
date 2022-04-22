<?php

declare(strict_types=1);

namespace App\Services;

use App\DataTransferObjects\Account\AccountDTO;
use App\Jobs\AccountActionJob;
use App\Models\LoyaltyAccount;
use App\Repositories\AccountRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function getBalance(int $accountId): float
    {
        if (!$this->accountRepository->accountExists($accountId)){
            throw new ModelNotFoundException('Account not found');
        }

        return $this->transactionService->getBalance($accountId);
    }
}
