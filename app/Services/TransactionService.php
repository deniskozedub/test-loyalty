<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\TransactionRepository;

class TransactionService
{
    public function __construct(
        private TransactionRepository $repository
    ) {}

    public function getBalance(int $accountId): float
    {
        return $this->repository->getBalance($accountId);
    }
}
