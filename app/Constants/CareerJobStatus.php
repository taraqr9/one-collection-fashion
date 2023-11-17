<?php

namespace App\Constants;
use ReflectionClass;

class CareerJobStatus
{
    const ACTIVE = 'Active';
    const IN_ACTIVE = 'In Active';

    public static function all(): array
    {
        $class = new ReflectionClass(__CLASS__);
        return $class->getConstants();
    }

    public static function getValueByKey($key)
    {
        return constant('self::' . $key);
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
