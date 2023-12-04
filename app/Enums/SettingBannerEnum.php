<?php

declare(strict_types=1);

namespace App\Enums;

enum SettingBannerEnum: string
{
    case TOP_BANNER = 'top_banner';
    case MINI_TOP_BANNER = 'mini_top_banner';
    case MINI_BOTTOM_BANNER = 'mini_bottom_banner';
    case MID_BANNER = 'mid_banner';
}
