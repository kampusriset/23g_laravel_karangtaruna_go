<?php
// app/Filament/Widgets/RecentTransactionsWidget.php (Versi Sederhana)

namespace App\Filament\Widgets;

use App\Models\PencatatanKeuangan;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentTransactionsWidget extends BaseWidget
{
    protected static ?string $heading = 'Transaksi Keuangan Terbaru';
    protected static ?int $sort = 5;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PencatatanKeuangan::query()->with(['kategori', 'anggota'])->latest()->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('primary'),
                Tables\Columns\BadgeColumn::make('kategori.status_uang')
                    ->label('Jenis')
                    ->colors([
                        'success' => 'debit',
                        'danger' => 'kredit',
                    ])
                    ->formatStateUsing(fn (string $state): string => $state === 'debit' ? 'Masuk' : 'Keluar'),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 30) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('nominal')
                    ->label('Nominal')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('anggota.nama_lengkap')
                    ->label('Dicatat Oleh')
                    ->badge()
                    ->color('gray'),
            ])
            ->paginated(false)
            ->searchable(false)
            ->defaultSort('created_at', 'desc');
    }
}