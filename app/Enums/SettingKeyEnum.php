<?php

declare(strict_types=1);

namespace App\Enums;

enum SettingKeyEnum: string
{
    case TopBanner = 'top_banner';
    case MiniTopBanner = 'mini_top_banner';
    case MiniBottomBanner = 'mini_bottom_banner';
    case MidBanner = 'mid_banner';
    case ShopByCategoryOne = 'shop_by_category_one';
    case ShopByCategoryTwo = 'shop_by_category_two';
    case ShopByCategoryThree = 'shop_by_category_three';
    case ShopByCategoryFour = 'shop_by_category_four';
    case ShopByCategoryFive = 'shop_by_category_five';
    case ShopByCategorySix = 'shop_by_category_six';
    case AboutUs = 'about_us';
    case ReturnPolicy = 'return_policy';
    case PrivacyPolicy = 'privacy_policy';
    case TermsAndConditions = 'terms_and_conditions';

    public function label(): string
    {
        return match ($this) {
            self::TopBanner => 'Top Banner',
            self::MiniTopBanner => 'Mini Top Banner',
            self::MiniBottomBanner => 'Mini Bottom Banner',
            self::MidBanner => 'Mid Banner',
            self::ShopByCategoryOne => 'Shop By Category One',
            self::ShopByCategoryTwo => 'Shop By Category Two',
            self::ShopByCategoryThree => 'Shop By Category Three',
            self::ShopByCategoryFour => 'Shop By Category Four',
            self::ShopByCategoryFive => 'Shop By Category Five',
            self::ShopByCategorySix => 'Shop By Category Six',
            self::AboutUs => 'About Us',
            self::ReturnPolicy => 'Return Policy',
            self::PrivacyPolicy => 'Privacy Policy',
            self::TermsAndConditions => 'Terms and Conditions',
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
