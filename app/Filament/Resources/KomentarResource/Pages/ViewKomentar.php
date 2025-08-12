<?php
namespace App\Filament\Resources\KomentarResource\Pages;

use App\Filament\Resources\KomentarResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKomentar extends ViewRecord
{
    protected static string $resource = KomentarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}