<?php

namespace App\Filament\Resources\CaixaResource\Pages;

use App\Filament\Resources\CaixaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaixa extends EditRecord
{
    protected static string $resource = CaixaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
