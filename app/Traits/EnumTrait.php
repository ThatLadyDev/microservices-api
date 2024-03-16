<?php

namespace App\Traits;

trait EnumTrait
{
    public static function toArray(string $type = 'all'): array
    {
        return array_map(
            fn(self $enum) => ($type === 'all') ? [$enum->name => $enum->value] : ($type === 'name' ? $enum->name : $enum->value),
            self::cases()
        );
    }

    public static function getCaseName($value): string
    {
        $name = '';
        foreach (self::cases() as $case) {
            if ($case->value === (int)$value) {
                $name = $case->name;
            }
        }
        return $name;
    }

    public static function getCaseValue($name): string
    {
        $value = 0;
        foreach (self::cases() as $case) {
            if ($case->name === strtoupper($name)) {
                $value = $case->value;
            }
        }
        return $value;
    }

}