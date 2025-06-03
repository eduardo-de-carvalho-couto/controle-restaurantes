<?php

// Primeiro, crie o widget:
// php artisan make:filament-widget TotalCaixaWidget --stats-overview

// app/Filament/Widgets/TotalCaixaWidget.php
namespace App\Filament\Widgets;

use App\Models\Caixa;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalCaixaWidget extends BaseWidget
{
    protected function getStats(): array
    {
        // Calcular total em caixa (entradas - saídas)
        $totalEntradas = Caixa::where('tipo_transacao', 'ENTRADA')
            ->sum('valor_transacao');
            
        $totalSaidas = Caixa::where('tipo_transacao', 'SAIDA')
            ->sum('valor_transacao');
            
        $totalCaixa = $totalEntradas - $totalSaidas;
        
        // Formatação da cor baseada no saldo
        $color = $totalCaixa >= 0 ? 'success' : 'danger';
        $icon = $totalCaixa >= 0 ? 'heroicon-o-currency-dollar' : 'heroicon-o-exclamation-triangle';
        
        return [
            Stat::make('Total em Caixa', 'R$ ' . number_format($totalCaixa, 2, ',', '.'))
                ->description('Saldo atual do caixa')
                ->descriptionIcon($icon)
                ->color($color)
                ->url(route('filament.admin.resources.caixas.index')) // Link para a página do Caixa
                ->extraAttributes([
                    'class' => 'cursor-pointer hover:bg-gray-50 transition-colors',
                ]),
        ];
    }
    
    // Atualizar a cada 30 segundos
    protected static ?string $pollingInterval = '30s';
    
    // Posição no dashboard
    protected static ?int $sort = 1;
}

// ==========================================
// ALTERNATIVA COM WIDGET PERSONALIZADO
// ==========================================

// Se quiser um widget mais customizado, crie assim:
// php artisan make:filament-widget TotalCaixaCard

// app/Filament/Widgets/TotalCaixaCard.php
namespace App\Filament\Widgets;

use App\Models\Caixa;
use Filament\Widgets\Widget;

class TotalCaixaCard extends Widget
{
    protected static string $view = 'filament.widgets.total-caixa-card';
    
    protected static ?int $sort = 1;
    
    public function getTotalCaixa(): array
    {
        $totalEntradas = Caixa::where('tipo_transacao', 'ENTRADA')
            ->sum('valor_transacao');
            
        $totalSaidas = Caixa::where('tipo_transacao', 'SAIDA')
            ->sum('valor_transacao');
            
        $total = $totalEntradas - $totalSaidas;
        
        return [
            'total' => $total,
            'formatado' => 'R$ ' . number_format($total, 2, ',', '.'),
            'cor' => $total >= 0 ? 'success' : 'danger',
            'entradas' => $totalEntradas,
            'saidas' => $totalSaidas,
        ];
    }
}

// ==========================================
// VIEW PARA O WIDGET PERSONALIZADO
// ==========================================

// resources/views/filament/widgets/total-caixa-card.blade.php
/*
<x-filament-widgets::widget>
    <x-filament::section>
        @php
            $dados = $this->getTotalCaixa();
        @endphp
        
        <div class="cursor-pointer hover:bg-gray-50 transition-colors rounded-lg p-4"
             onclick="window.location.href='{{ route('filament.admin.resources.caixas.index') }}'">
            
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Total em Caixa</h3>
                    <p class="text-2xl font-bold {{ $dados['cor'] === 'success' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $dados['formatado'] }}
                    </p>
                </div>
                
                <div class="p-3 rounded-full {{ $dados['cor'] === 'success' ? 'bg-green-100' : 'bg-red-100' }}">
                    @if($dados['cor'] === 'success')
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    @else
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    @endif
                </div>
            </div>
            
            <div class="mt-4 flex justify-between text-sm text-gray-500">
                <span>Entradas: R$ {{ number_format($dados['entradas'], 2, ',', '.') }}</span>
                <span>Saídas: R$ {{ number_format($dados['saidas'], 2, ',', '.') }}</span>
            </div>
            
            <div class="mt-2 text-xs text-gray-400 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
                Clique para ver detalhes
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
*/

// ==========================================
// REGISTRAR NO DASHBOARD
// ==========================================

// app/Filament/Pages/Dashboard.php
namespace App\Filament\Pages;

use App\Filament\Widgets\TotalCaixaWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            TotalCaixaWidget::class,
            // outros widgets...
        ];
    }
}

// OU no AdminPanelProvider se estiver usando widgets globais:
// app/Providers/Filament/AdminPanelProvider.php
/*
->widgets([
    TotalCaixaWidget::class,
])
*/