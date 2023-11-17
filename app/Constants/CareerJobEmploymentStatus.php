<?php

namespace App\Constants;
use ReflectionClass;

class CareerJobEmploymentStatus
{
    const FULL_TIME = 'Full time';
    const PART_TIME = 'Part time';
    const CONTRACTUAL = 'Contractual';

    public static function all(): array
    {
        $class = new ReflectionClass(__CLASS__);
        return $class->getConstants();
    }

    public static function getValueByKey($key)
    {
        return constant('self::' . $key);
    }
}
