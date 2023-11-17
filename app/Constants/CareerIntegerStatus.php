<?php

namespace App\Constants;
use ReflectionClass;

class CareerIntegerStatus
{
    const ACTIVE = '1';
    const IN_ACTIVE = '0';

    public static function all(): array
    {
        $class = new ReflectionClass(__CLASS__);
        return $class->getConstants();
    }

    public static function getKeyByValue($value): int|string|null
    {
        $constants = array_flip(self::all());
        if (isset($constants[$value])) {
            return $constants[$value];
        }
        return null;
    }
}
