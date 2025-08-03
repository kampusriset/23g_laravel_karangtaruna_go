<?php

namespace App\Filament\Resources\PencatatanKeuanganResource\Pages;

use App\Filament\Resources\PencatatanKeuanganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPencatatanKeuangan extends EditRecord
{
    protected static string $resource = PencatatanKeuanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
