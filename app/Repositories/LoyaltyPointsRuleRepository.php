<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\LoyaltyPointsRule;

class LoyaltyPointsRuleRepository extends BaseRepository
{
    public function model(): string
    {
        return LoyaltyPointsRule::class;
    }

    public function getById(int $id): ?LoyaltyPointsRule
    {
        return $this->query()->findOrFail($id);
    }
}
