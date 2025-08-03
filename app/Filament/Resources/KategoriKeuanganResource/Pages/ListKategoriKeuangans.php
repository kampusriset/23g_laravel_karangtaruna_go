<?php

namespace App\Filament\Resources\KategoriKeuanganResource\Pages;

use App\Filament\Resources\KategoriKeuanganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriKeuangans extends ListRecords
{
    protected static string $resource = KategoriKeuanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
