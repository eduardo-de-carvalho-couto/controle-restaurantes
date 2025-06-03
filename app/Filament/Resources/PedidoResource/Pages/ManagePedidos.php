<?php

namespace App\Filament\Resources\PedidoResource\Pages;

use App\Filament\Resources\PedidoResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;

class ManagePedidos extends ManageRecords
{
    protected static string $resource = PedidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->using(function (array $data, string $model) {
                    foreach ($data['itens'] as $pedido) {
                        $model::create([
                            'id_comanda' => $data['id_comanda'],
                            'cod_prod' => $pedido['cod_prod'],
                            'quantidade' => $pedido['quantidade'],
                        ]);
                    }
                }),
        ];
    }
}
