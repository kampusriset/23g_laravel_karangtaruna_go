<?php
// app/Filament/Resources/PencatatanKeuanganResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\PencatatanKeuanganResource\Pages;
use App\Models\PencatatanKeuangan;
use App\Models\KategoriKeuangan;
use App\Models\Anggota;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PencatatanKeuanganResource extends Resource
{
    protected static ?string $model = PencatatanKeuangan::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Pencatatan Keuangan';
    protected static ?string $modelLabel = 'Pencatatan Keuangan';
    protected static ?string $pluralModelLabel = 'Pencatatan Keuangan';
    protected static ?string $navigationGroup = 'Keuangan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Transaksi')
                    ->schema([
                        Forms\Components\Select::make('kategori_id')
                            ->label('Kategori Keuangan')
                            ->options(KategoriKeuangan::where('is_active', '1')->pluck('nama_kategori', 'id_kategori'))
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('created_by')
                            ->label('Dicatat Oleh')
                            ->options(Anggota::where('is_active', '1')->pluck('nama_lengkap', 'id_anggota'))
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('nominal')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('0'),
                        Forms\Components\Textarea::make('deskripsi')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('bukti_upload')
                            ->label('Bukti Transaksi')
                            ->image()
                            ->directory('bukti-transaksi')
                            ->visibility('private')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('kategori.status_uang')
                    ->label('Jenis')
                    ->colors([
                        'success' => 'debit',
                        'danger' => 'kredit',
                    ])
                    ->formatStateUsing(fn (string $state): string => $state === 'debit' ? 'Pemasukan' : 'Pengeluaran'),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->limit(30)
                    ->wrap(),
                Tables\Columns\TextColumn::make('nominal')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('anggota.nama_lengkap')
                    ->label('Dicatat Oleh')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('bukti_upload')
                    ->label('Bukti')
                    ->visibility('private'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama_kategori'),
                Tables\Filters\Filter::make('jenis_transaksi')
                    ->form([
                        Forms\Components\Select::make('status_uang')
                            ->label('Jenis Transaksi')
                            ->options([
                                'debit' => 'Pemasukan',
                                'kredit' => 'Pengeluaran',
                            ]),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query->when(
                            $data['status_uang'],
                            fn (Builder $query, $status): Builder => $query->whereHas(
                                'kategori',
                                fn (Builder $query) => $query->where('status_uang', $status)
                            )
                        );
                    }),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('dari_tanggal'),
                        Forms\Components\DatePicker::make('sampai_tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPencatatanKeuangans::route('/'),
            'create' => Pages\CreatePencatatanKeuangan::route('/create'),
            'edit' => Pages\EditPencatatanKeuangan::route('/{record}/edit'),
        ];
    }
}