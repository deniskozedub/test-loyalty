<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use App\Enums\TypeTokenEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'user' => UserResource::make($this->resource['user']),
            'token' =>[
                'type' => TypeTokenEnum::bearer()->label,
                'value' => $this->resource['token']
            ]
        ];
    }
}
