<?php

namespace App\Filament\Widgets;

use App\Models\Anggota;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class AnggotaTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Daftar Anggota Terbaru';
    protected static ?int $sort = 3;

    // Responsif column span
    protected int|string|array $columnSpan = [
        'md' => 2,
        'xl' => 3,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(Anggota::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jabatan')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\BadgeColumn::make('gender')
                    ->label('Gender')
                    ->colors([
                        'primary' => 'M',
                        'success' => 'F',
                    ])
                    ->formatStateUsing(fn (string $state): string => $state === 'M' ? 'L' : 'P'),

                Tables\Columns\BadgeColumn::make('is_active')
                    ->label('Status')
                    ->colors([
                        'success' => '1',
                        'danger' => '0',
                    ])
                    ->formatStateUsing(fn (string $state): string => $state === '1' ? 'Aktif' : 'Nonaktif'),
            ])
            ->paginated(false)
            ->searchable(false)
            ->defaultSort('created_at', 'desc');
    }
}
