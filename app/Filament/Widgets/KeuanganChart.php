<?php


namespace App\Filament\Widgets;

use App\Models\PencatatanKeuangan;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class KeuanganChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pemasukan dan Pengeluaran';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        // Ambil data 12 bulan terakhir
        $months = collect();
        $pemasukan = collect();
        $pengeluaran = collect();

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthName = $date->format('M Y');
            $months->push($monthName);

            // Total pemasukan per bulan
            $totalPemasukan = PencatatanKeuangan::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->whereHas('kategori', function ($query) {
                    $query->where('status_uang', 'debit');
                })
                ->sum('nominal');

            // Total pengeluaran per bulan
            $totalPengeluaran = PencatatanKeuangan::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->whereHas('kategori', function ($query) {
                    $query->where('status_uang', 'kredit');
                })
                ->sum('nominal');

            $pemasukan->push($totalPemasukan);
            $pengeluaran->push($totalPengeluaran);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukan',
                    'data' => $pemasukan->toArray(),
                    'backgroundColor' => 'rgba(34, 197, 94, 0.2)',
                    'borderColor' => 'rgb(34, 197, 94)',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
                [
                    'label' => 'Pengeluaran',
                    'data' => $pengeluaran->toArray(),
                    'backgroundColor' => 'rgba(239, 68, 68, 0.2)',
                    'borderColor' => 'rgb(239, 68, 68)',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
            ],
            'labels' => $months->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return "Rp " + value.toLocaleString("id-ID"); }',
                    ],
                ],
            ],
        ];
    }
}