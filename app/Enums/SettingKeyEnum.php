<?php

declare(strict_types=1);

namespace App\Enums;

enum SettingKeyEnum: string
{
    case TopBanner = 'top_banner';
    case MiniTopBanner = 'mini_top_banner';
    case MiniBottomBanner = 'mini_bottom_banner';
    case MidBanner = 'mid_banner';

    public function label(): string
    {
        return match ($this) {
            self::TopBanner       => 'Top Banner',
            self::MiniTopBanner   => 'Mini Top Banner',
            self::MiniBottomBanner=> 'Mini Bottom Banner',
            self::MidBanner       => 'Mid Banner',
        };
    }

    /** Quick options array for Filament or forms */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }
}
