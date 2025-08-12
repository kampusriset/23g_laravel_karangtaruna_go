<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiskusiResource\Pages;
use App\Models\Diskusi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DiskusiResource extends Resource
{
    protected static ?string $model = Diskusi::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Komunikasi';
    protected static ?string $navigationLabel = 'Diskusi';
    protected static ?string $modelLabel = 'Diskusi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                    
                Forms\Components\Textarea::make('teks')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->sortable()
                    ->searchable(),
                    
                Tables\Columns\TextColumn::make('teks')
                    ->limit(80)
                    ->wrap(),
                    
                Tables\Columns\TextColumn::make('jumlah_komentar')
                    ->label('Komentar')
                    ->state(fn($record) => $record->komentar->count())
                    ->badge()
                    ->color('success'),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListDiskusi::route('/'),
            'create' => Pages\CreateDiskusi::route('/create'),
            'edit' => Pages\EditDiskusi::route('/{record}/edit'),
            'view' => Pages\ViewDiskusi::route('/{record}'),
        ];
    }
}
