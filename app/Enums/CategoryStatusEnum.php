<?php

declare(strict_types=1);

namespace App\Enums;

enum CategoryStatusEnum: string
{
    case ACTIVE = 'ACTIVE';
    case IN_ACTIVE = 'IN_ACTIVE';
}
