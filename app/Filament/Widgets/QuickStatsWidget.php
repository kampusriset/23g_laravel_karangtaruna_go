<?php
// app/Filament/Widgets/QuickStatsWidget.php

namespace App\Filament\Widgets;

use App\Models\PencatatanKeuangan;
use App\Models\Anggota;
use App\Models\Agenda;
use App\Models\KategoriKeuangan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class QuickStatsWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        // Total pemasukan bulan ini
        $pemasukanBulanIni = PencatatanKeuangan::whereHas('kategori', function ($query) {
            $query->where('status_uang', 'debit');
        })
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->sum('nominal');

        // Total pengeluaran bulan ini
        $pengeluaranBulanIni = PencatatanKeuangan::whereHas('kategori', function ($query) {
            $query->where('status_uang', 'kredit');
        })
        ->whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->sum('nominal');

        // Total pemasukan keseluruhan
        $totalPemasukan = PencatatanKeuangan::whereHas('kategori', function ($query) {
            $query->where('status_uang', 'debit');
        })->sum('nominal');

        // Total pengeluaran keseluruhan
        $totalPengeluaran = PencatatanKeuangan::whereHas('kategori', function ($query) {
            $query->where('status_uang', 'kredit');
        })->sum('nominal');

        // Saldo
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Jumlah anggota aktif
        $anggotaAktif = Anggota::where('is_active', '1')->count();
        $totalAnggota = Anggota::count();

        // Jumlah agenda bulan ini dan mendatang
        $agendaBulanIni = Agenda::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->count();
        
        $agendaMendatang = Agenda::where('tanggal', '>=', now())->count();

        // Kategori aktif
        $kategoriAktif = KategoriKeuangan::where('is_active', '1')->count();

        return [
            Stat::make('Anggota Aktif', $anggotaAktif . ' / ' . $totalAnggota)
                ->description('Total anggota terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5]),
            
            Stat::make('Pemasukan Bulan Ini', 'Rp ' . number_format($pemasukanBulanIni, 0, ',', '.'))
                ->description('Bulan ' . now()->format('F Y'))
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([1, 3, 5, 10, 15, 20, 40]),
            
            Stat::make('Pengeluaran Bulan Ini', 'Rp ' . number_format($pengeluaranBulanIni, 0, ',', '.'))
                ->description('Bulan ' . now()->format('F Y'))
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([20, 15, 10, 8, 5, 3, 1]),
            
            Stat::make('Saldo Total', 'Rp ' . number_format($saldo, 0, ',', '.'))
                ->description($saldo >= 0 ? 'Surplus' : 'Defisit')
                ->descriptionIcon($saldo >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($saldo >= 0 ? 'success' : 'danger')
                ->chart([10, 20, 15, 25, 30, 35, 40]),
            
            Stat::make('Agenda Bulan Ini', $agendaBulanIni)
                ->description($agendaMendatang . ' agenda mendatang')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('warning')
                ->chart([2, 3, 1, 4, 2, 3, 2]),
            
            Stat::make('Kategori Keuangan', $kategoriAktif)
                ->description('Kategori aktif')
                ->descriptionIcon('heroicon-m-tag')
                ->color('info')
                ->chart([5, 10, 15, 20, 25, 30, 35]),
        ];
    }
}