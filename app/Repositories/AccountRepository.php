<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DataTransferObjects\Account\AccountDTO;
use App\Models\LoyaltyAccount;

class AccountRepository extends BaseRepository
{
    public function model(): string
    {
        return LoyaltyAccount::class;
    }

    public function create(AccountDTO $DTO): ?LoyaltyAccount
    {
        return $this->query()
                    ->create([
                        'card' => $DTO->card,
                        'email' => $DTO->email,
                        'phone' => $DTO->phone
                    ]);
    }

    public function accountExists(int $id): bool
    {
        return  $this->query()
                     ->where('id', $id)
                     ->exists();
    }

    public function changeStatus(int $id): ?LoyaltyAccount
    {
        $account = $this->query()
                        ->where('id', $id)
                        ->firstOrFail();
        $account->active = !$account->active;
        $account->save();

        return $account;
    }
}
