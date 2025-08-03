<?php
// app/Filament/Resources/AgendaResource.php

namespace App\Filament\Resources;

use App\Filament\Resources\AgendaResource\Pages;
use App\Models\Agenda;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Agenda Kegiatan';
    protected static ?string $modelLabel = 'Agenda';
    protected static ?string $pluralModelLabel = 'Agenda Kegiatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Agenda')
                    ->schema([
                        Forms\Components\TextInput::make('nama_agenda')
                            ->label('Nama Agenda')
                            ->required()
                            ->maxLength(100)
                            ->columnSpanFull(),
                        Forms\Components\DatePicker::make('tanggal')
                            ->required()
                            ->default(now()),
                        Forms\Components\TimePicker::make('waktu_mulai')
                            ->label('Waktu Mulai')
                            ->required(),
                        Forms\Components\TimePicker::make('waktu_selesai')
                            ->label('Waktu Selesai')
                            ->required(),
                        Forms\Components\Textarea::make('deskripsi')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_agenda')
                    ->label('Nama Agenda')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('waktu_mulai')
                    ->label('Waktu Mulai')
                    ->time(),
                Tables\Columns\TextColumn::make('waktu_selesai')
                    ->label('Waktu Selesai')
                    ->time(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->limit(50)
                    ->wrap(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('dari_tanggal'),
                        Forms\Components\DatePicker::make('sampai_tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '>=', $date),
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '<=', $date),
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
            ->defaultSort('tanggal', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }
}