<?php

namespace App\Filament\Widgets;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Dashboard extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::count())
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Total Products', Product::count())
                ->description('Available products')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success'),

            Stat::make('Total Orders', Order::count())
                ->description('All placed orders')
                ->descriptionIcon('heroicon-m-shopping-cart')
                ->color('primary'),

            Stat::make('Pending Orders', Order::where('status', OrderStatusEnum::Pending)->count())
                ->description('Waiting for approval')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Approved Orders', Order::where('status', OrderStatusEnum::Approved)->count())
                ->description('Confirmed and processing')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),

            Stat::make('Completed Orders', Order::where('status', OrderStatusEnum::Completed)->count())
                ->description('Successfully delivered')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Canceled Orders', Order::where('status', OrderStatusEnum::Canceled)->count())
                ->description('Canceled by admin/user')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }

    protected function getColumns(): int
    {
        return 4;
    }
}
