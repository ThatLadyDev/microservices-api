<?php

namespace App\Traits;

trait EnumTrait
{
    public static function toArray(string $type = 'all'): array
    {
        return array_map(
            fn(self $enum) => $enum->name,
            self::cases()
        );
    }
}
