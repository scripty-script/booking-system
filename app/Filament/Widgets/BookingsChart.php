<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;

class BookingsChart extends LineChartWidget
{
    protected static ?string $heading = 'Bookings per month';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Bookings',
                    'data' => [100, 150, 200, 150, 150, 169, 145, 274, 365, 245, 377, 589],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
