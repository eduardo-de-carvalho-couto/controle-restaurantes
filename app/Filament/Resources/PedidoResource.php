<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidoResource\Pages;
use App\Filament\Resources\PedidoResource\RelationManagers;
use App\Models\Pedido;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_comanda')
                    ->label('Comanda')
                    ->relationship('comanda', 'id_comanda')
                    ->required(),

                Forms\Components\Select::make('cod_prod')
                    ->label('Produto')
                    ->relationship('produto', 'nome_prod')
                    ->required(),

                Forms\Components\TextInput::make('quantidade')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_pedido')->label('ID'),
                Tables\Columns\TextColumn::make('comanda.id_comanda')->label('Comanda'),
                Tables\Columns\TextColumn::make('produto.nome_prod')->label('Produto'),
                Tables\Columns\TextColumn::make('quantidade')->label('Qtd'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePedidos::route('/'),
        ];
    }
}
