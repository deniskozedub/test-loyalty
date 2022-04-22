<?php

declare(strict_types=1);

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self card()
 * @method static self email()
 * @method static self phone()
*/

class AccountTypeEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'card' => 0,
            'email' => 1,
            'phone' => 2,
        ];
    }
}
