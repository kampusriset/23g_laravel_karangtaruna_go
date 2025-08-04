<?php
// app/Filament/Widgets/KategoriKeuanganTableWidget.php (Versi Sederhana)

namespace App\Filament\Widgets;

use App\Models\KategoriKeuangan;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class KategoriKeuanganTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Kategori Keuangan';
    protected static ?int $sort = 4;
    protected int | string | array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                KategoriKeuangan::query()
                ->withCount('pencatatanKeuangan') 
                ->where('is_active', '1')
                ->latest()
                ->limit(8)
            )
            ->columns([
                Tables\Columns\TextColumn::make('nama_kategori')
                    ->label('Nama Kategori')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status_uang')
                    ->label('Jenis')
                    ->colors([
                        'success' => 'debit',
                        'danger' => 'kredit',
                    ])
                    ->formatStateUsing(fn (string $state): string => $state === 'debit' ? 'Pemasukan' : 'Pengeluaran'),
                Tables\Columns\TextColumn::make('pencatatan_keuangan_count')
                    ->label('Transaksi')
                    ->counts('pencatatanKeuangan')
                    ->badge()
                    ->color('warning')
                    ->formatStateUsing(fn ($state) => $state ?? 0),
            ])
            ->paginated(false)
            ->searchable(false);
    }
}