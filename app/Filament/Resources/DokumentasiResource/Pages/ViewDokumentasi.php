<?php
namespace App\Filament\Resources\DokumentasiResource\Pages;

use App\Filament\Resources\DokumentasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDokumentasi extends ViewRecord
{
    protected static string $resource = DokumentasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}