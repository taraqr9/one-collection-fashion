<?php

declare(strict_types=1);

namespace App\Enums;

enum DefaultSortingEnum: string
{
    case DefaultSorting = 'default_sorting';
    case PriceLowHigh = 'price_low_high';
    case PriceHighLow = 'price_high_low';

    public function label(): string
    {
        return match ($this) {
            self::DefaultSorting => 'Default Sorting',
            self::PriceLowHigh => 'Price: Low to High',
            self::PriceHighLow => 'Price: High to Low',
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
