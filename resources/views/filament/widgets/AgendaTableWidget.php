<?php
// app/Filament/Widgets/AgendaTableWidget.php
// Ganti AgendaCalendarWidget dengan ini

namespace App\Filament\Widgets;

use App\Models\Agenda;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class AgendaTableWidget extends BaseWidget
{
    protected static ?string $heading = 'Agenda Mendatang';
    protected static ?int $sort = 6;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Agenda::query()->where('tanggal', '>=', now())->orderBy('tanggal')->orderBy('waktu_mulai')->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('nama_agenda')
                    ->label('Nama Agenda')
                    ->searchable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('waktu_mulai')
                    ->label('Waktu Mulai')
                    ->time('H:i'),
                
                Tables\Columns\TextColumn::make('waktu_selesai')
                    ->label('Waktu Selesai')
                    ->time('H:i'),
                
                Tables\Columns\TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 30) {
                            return null;
                        }
                        return $state;
                    }),
                
                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),
                
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'selesai',
                        'warning' => 'berlangsung',
                        'primary' => 'akan_datang',
                    ])
                    ->formatStateUsing(function (string $state): string {
                        return match($state) {
                            'selesai' => 'Selesai',
                            'berlangsung' => 'Berlangsung',
                            'akan_datang' => 'Akan Datang',
                            default => 'Tidak Diketahui'
                        };
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (Agenda $record): string => route('filament.admin.resources.agendas.edit', $record))
                    ->color('primary'),
                
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-m-eye')
                    ->url(fn (Agenda $record): string => route('filament.admin.resources.agendas.view', $record))
                    ->color('info'),
            ])
            ->defaultSort('tanggal', 'asc');
    }
}