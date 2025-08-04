<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class BannerWidget extends Widget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';
    
    protected static string $view = 'filament.widgets.banner-widget';

    public function getViewData(): array
    {
        return [
            'bannerImage' => asset('images/banner.jpg'),
            'title' => 'Sistem Keuangan',
            'subtitle' => 'Kelola keuangan dengan mudah dan efisien',
        ];
    }
}
