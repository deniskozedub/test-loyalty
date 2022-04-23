<?php

declare(strict_types=1);

namespace App\Http\Resources\Transaction;

use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'pointsRule' => $this->points_rule,
            'pointsAmount' => $this->points_amount,
            'description' => $this->description,
        ];
    }
}
