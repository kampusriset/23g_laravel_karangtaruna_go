<?php

namespace App\Filament\Resources\PencatatanKeuanganResource\Pages;

use App\Filament\Resources\PencatatanKeuanganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPencatatanKeuangans extends ListRecords
{
    protected static string $resource = PencatatanKeuanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
