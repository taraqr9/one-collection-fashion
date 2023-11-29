<?php

declare(strict_types=1);
namespace App\Enums;

enum ProductStatusEnum : string
{
    case ACTIVE = 'Active';
    case IN_ACTIVE = 'In Active';
}
