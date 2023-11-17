<?php

declare(strict_types=1);
namespace App\Enums;

enum AdminTypeEnum : string
{
    case REGULAR = 'REGULAR';
    case SYSTEM_ADMIN = 'SYSTEM_ADMIN';
}
