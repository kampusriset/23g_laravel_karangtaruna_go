<?php
// app/Filament/Resources/KategoriKeuanganResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriKeuanganResource\Pages;
use App\Models\KategoriKeuangan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KategoriKeuanganResource extends Resource
{
    protected static ?string $model = KategoriKeuangan::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Kategori Keuangan';
    protected static ?string $modelLabel = 'Kategori Keuangan';
    protected static ?string $pluralModelLabel = 'Kategori Keuangan';
    protected static ?string $navigationGroup = 'Keuangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Kategori')
                    ->schema([
                        Forms\Components\TextInput::make('nama_kategori')
                            ->label('Nama Kategori')
                            ->required()
                            ->maxLength(50),
                        Forms\Components\Select::make('status_uang')
                            ->label('Jenis Transaksi')
                            ->options([
                                'debit' => 'Pemasukan',
                                'kredit' => 'Pengeluaran',
                            ])
                            ->required(),
                        Forms\Components\Select::make('is_active')
                            ->label('Status Aktif')
                            ->options([
                                '1' => 'Aktif',
                                '0' => 'Tidak Aktif',
                            ])
                            ->default('1')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kategori')
                    ->label('Nama Kategori')
                    ->searchable(),
                Tables\Columns\BadgeColumn::make('status_uang')
                    ->label('Jenis Transaksi')
                    ->colors([
                        'success' => 'debit',
                        'danger' => 'kredit',
                    ])
                    ->formatStateUsing(fn (string $state): string => $state === 'debit' ? 'Pemasukan' : 'Pengeluaran'),
                Tables\Columns\BadgeColumn::make('is_active')
                    ->label('Status')
                    ->colors([
                        'success' => '1',
                        'danger' => '0',
                    ])
                    ->formatStateUsing(fn (string $state): string => $state === '1' ? 'Aktif' : 'Tidak Aktif'),
                Tables\Columns\TextColumn::make('pencatatanKeuangan_count')
                    ->label('Jumlah Transaksi')
                    ->counts('pencatatanKeuangan'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_uang')
                    ->label('Jenis Transaksi')
                    ->options([
                        'debit' => 'Pemasukan',
                        'kredit' => 'Pengeluaran',
                    ]),
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        '1' => 'Aktif',
                        '0' => 'Tidak Aktif',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKategoriKeuangans::route('/'),
            'create' => Pages\CreateKategoriKeuangan::route('/create'),
            'edit' => Pages\EditKategoriKeuangan::route('/{record}/edit'),
        ];
    }
}