<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament-panels::pages.dashboard';

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\KeuanganStats::class,
            \App\Filament\Widgets\KeuanganChart::class,
        ];
    }
}