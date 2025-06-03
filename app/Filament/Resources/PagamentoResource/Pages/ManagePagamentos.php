<?php

namespace App\Filament\Resources\PagamentoResource\Pages;

use App\Filament\Resources\PagamentoResource;
use App\Models\Caixa;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePagamentos extends ManageRecords
{
    protected static string $resource = PagamentoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->after(function ($record) {
                $comanda = $record->comanda;

                $valorTransacao = $comanda->pedidos->sum(function ($pedido) {
                    return ($pedido->produto->valor_prod ?? 0) * ($pedido->quantidade ?? 1);
                });

                Caixa::create([
                    'id_pagamento' => $record['id_pagamento'],
                    'tipo_transacao' => 'entrada',
                    'valor_transacao' => $valorTransacao,
                    'data_transacao' => now(),
                ]);
            }),
        ];
    }
}
