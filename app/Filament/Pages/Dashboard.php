<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BasePage;
use Filament\Widgets as BaseWidgets;

class Dashboard extends BasePage
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.dashboard';

    protected function getWidgets(): array
    {
        return [
            BaseWidgets\AccountWidget::class,
            \App\Filament\Widgets\StatsOverview::class,
            \App\Filament\Widgets\BookingsChart::class,
            \App\Filament\Widgets\CustomersChart::class,
        ];
    }
}
