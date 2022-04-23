<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\LoyaltyPointsRule;
use App\Repositories\LoyaltyPointsRuleRepository;

class LoyaltyPointsRuleService
{
    public function __construct(
        private LoyaltyPointsRuleRepository $pointsRuleRepository
    ) {}

    public function getById(int $id): ?LoyaltyPointsRule
    {
        return $this->pointsRuleRepository->getById($id);
    }
}
