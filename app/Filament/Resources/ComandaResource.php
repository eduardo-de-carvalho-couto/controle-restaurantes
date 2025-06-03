<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComandaResource\Pages;
use App\Filament\Resources\ComandaResource\RelationManagers;
use App\Models\Comanda;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class ComandaResource extends Resource
{
    protected static ?string $model = Comanda::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_cliente')
                ->label('Mesa(Nome do Cliente)')
                ->relationship('mesa', 'nome_cliente')
                ->required(),

                // TextInput::make('valor_comanda')
                //     ->label('Valor da Comanda')
                //     ->numeric()
                //     ->required(),

                DateTimePicker::make('data_comanda')
                    ->label('Data da Comanda')
                    ->default(now())
                    ->required(),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->whereDoesntHave('pagamentos'); // <- aqui aplica o filtro
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_comanda')
                    ->label('ID'),

                TextColumn::make('mesa.nome_cliente')
                    ->label('Cliente'),

                TextColumn::make('valor_comanda')
                    ->label('Valor da Comanda')
                    ->getStateUsing(function ($record) {
                        return $record->pedidos()
                            ->join('produto', 'pedido.cod_prod', '=', 'produto.cod_prod')
                            ->selectRaw('SUM(pedido.quantidade * produto.valor_prod) as total')
                            ->value('total') ?? 0;
                    })
                    ->money('BRL', true),

                TextColumn::make('data_comanda')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComandas::route('/'),
            'create' => Pages\CreateComanda::route('/create'),
            'edit' => Pages\EditComanda::route('/{record}/edit'),
        ];
    }
}
