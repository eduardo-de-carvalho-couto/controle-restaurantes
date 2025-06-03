<?php

namespace App\Filament\Widgets;

use App\Models\Mesa;
use App\Models\Comanda;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MesasIndividuaisWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    
    protected function getStats(): array
    {
        $mesas = Mesa::orderBy('numero_mesa')->get();
    
        $stats = [];
        
        foreach ($mesas as $mesa) {
            $comandaAtiva = Comanda::where('id_cliente', $mesa->id_cliente)
                ->whereDoesntHave('pagamentos')
                ->first();
            
            $status = $comandaAtiva ? 'Ocupada' : 'Livre';
            $color = $comandaAtiva ? 'warning' : 'success';
            $icon = $comandaAtiva ? 'heroicon-o-user-group' : 'heroicon-o-check-circle';
            
            $stats[] = Stat::make("Mesa {$mesa->numero_mesa}", $status)
                ->description($mesa->nome_cliente ?: 'Sem cliente')
                ->descriptionIcon($icon)
                ->color($color);
        }
        
        return $stats;
    }
    
    protected static ?string $pollingInterval = '30s';
}
