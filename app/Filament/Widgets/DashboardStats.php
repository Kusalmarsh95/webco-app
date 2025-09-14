<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductCategory;

class DashboardStats extends BaseWidget
{
    protected static string $view = 'filament.widgets.dashboard-stats';

    protected function getCards(): array
    {
        return [
            Card::make('Products', Product::count())
                ->description('Total Products')
                ->color('blue'),

            Card::make('Product Types', ProductType::count())
                ->description('Total Types')
                ->color('green'),

            Card::make('Categories', ProductCategory::count())
                ->description('Total Categories')
                ->color('yellow'),
        ];
    }
}
