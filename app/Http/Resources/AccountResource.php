<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'card' => $this->card,
            'email' => $this->email,
            'phone' => $this->phone
        ];
    }
}
