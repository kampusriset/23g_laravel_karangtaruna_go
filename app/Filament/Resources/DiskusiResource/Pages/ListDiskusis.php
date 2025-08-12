<?php

namespace App\Filament\Resources\DiskusiResource\Pages;

use App\Filament\Resources\DiskusiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiskusis extends ListRecords
{
    protected static string $resource = DiskusiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
