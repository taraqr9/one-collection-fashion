<?php

namespace App\Enums;

enum StatusEnum: string
{
    case Active = 'active';

    case InActive = 'inactive';

    public function isActive(): bool
    {
        return $this === StatusEnum::Active;
    }
}
