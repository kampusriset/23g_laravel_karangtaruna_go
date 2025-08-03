<?php
// app/Filament/Widgets/KeuanganStats.php

namespace App\Filament\Widgets;

use App\Models\PencatatanKeuangan;
use App\Models\Anggota;
use App\Models\Agenda;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class KeuanganStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Total pemasukan
        $totalPemasukan = PencatatanKeuangan::whereHas('kategori', function ($query) {
            $query->where('status_uang', 'debit');
        })->sum('nominal');

        // Total pengeluaran
        $totalPengeluaran = PencatatanKeuangan::whereHas('kategori', function ($query) {
            $query->where('status_uang', 'kredit');
        })->sum('nominal');

        // Saldo
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Jumlah anggota aktif
        $anggotaAktif = Anggota::where('is_active', '1')->count();

        // Jumlah agenda bulan ini
        $agendaBulanIni = Agenda::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->count();

        return [
            Stat::make('Total Pemasukan', 'Rp ' . number_format($totalPemasukan, 0, ',', '.'))
                ->description('Total pemasukan keseluruhan')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            
            Stat::make('Total Pengeluaran', 'Rp ' . number_format($totalPengeluaran, 0, ',', '.'))
                ->description('Total pengeluaran keseluruhan')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            
            Stat::make('Saldo', 'Rp ' . number_format($saldo, 0, ',', '.'))
                ->description($saldo >= 0 ? 'Surplus' : 'Defisit')
                ->descriptionIcon($saldo >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($saldo >= 0 ? 'success' : 'danger'),
            
            Stat::make('Anggota Aktif', $anggotaAktif)
                ->description('Jumlah anggota aktif')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
            
            Stat::make('Agenda Bulan Ini', $agendaBulanIni)
                ->description('Agenda bulan ' . now()->format('F Y'))
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning'),
        ];
    }
}