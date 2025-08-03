<?php
// app/Filament/Widgets/AgendaCalendarWidget.php

namespace App\Filament\Widgets;

use App\Models\Agenda;
use Filament\Widgets\Widget;
use Carbon\Carbon;

class AgendaCalendarWidget extends Widget
{
    protected static string $view = 'filament.widgets.simple-agenda-calendar';
    protected static ?string $heading = 'Kalender Agenda';
    protected static ?int $sort = 6;
    protected int | string | array $columnSpan = 'full';

    public function getViewData(): array
    {
        $currentDate = now();
        
        // Agenda hari ini
        $agendaHariIni = Agenda::whereDate('tanggal', $currentDate->toDateString())
            ->orderBy('waktu_mulai')
            ->get();

        // Agenda minggu ini
        $startOfWeek = $currentDate->copy()->startOfWeek();
        $endOfWeek = $currentDate->copy()->endOfWeek();
        $agendaMingguIni = Agenda::whereBetween('tanggal', [$startOfWeek, $endOfWeek])
            ->orderBy('tanggal')
            ->orderBy('waktu_mulai')
            ->get();

        // Agenda bulan ini
        $startOfMonth = $currentDate->copy()->startOfMonth();
        $endOfMonth = $currentDate->copy()->endOfMonth();
        $agendaBulanIni = Agenda::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->orderBy('tanggal')
            ->orderBy('waktu_mulai')
            ->get();

        // Agenda mendatang (mulai besok)
        $agendaMendatang = Agenda::where('tanggal', '>', $currentDate->toDateString())
            ->orderBy('tanggal')
            ->orderBy('waktu_mulai')
            ->limit(10)
            ->get();

        return [
            'currentDate' => $currentDate,
            'agendaHariIni' => $agendaHariIni,
            'agendaMingguIni' => $agendaMingguIni,
            'agendaBulanIni' => $agendaBulanIni,
            'agendaMendatang' => $agendaMendatang,
        ];
    }
}