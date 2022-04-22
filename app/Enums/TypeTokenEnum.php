<?php

declare(strict_types=1);

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self basic()
 * @method static self bearer()
*/

class TypeTokenEnum extends Enum
{
    protected static function values(): array
    {
        return [
            'basic' => 0,
            'bearer' => 1,
        ];
    }
}
