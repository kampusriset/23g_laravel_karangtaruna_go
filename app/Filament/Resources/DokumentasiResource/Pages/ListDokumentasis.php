<?php

namespace App\Filament\Resources\DokumentasiResource\Pages;

use App\Filament\Resources\DokumentasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDokumentasis extends ListRecords
{
     protected static string $resource = DokumentasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
