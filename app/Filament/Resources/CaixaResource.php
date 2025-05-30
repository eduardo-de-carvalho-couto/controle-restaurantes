<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CaixaResource\Pages;
use App\Filament\Resources\CaixaResource\RelationManagers;
use App\Models\Caixa;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CaixaResource extends Resource
{
    protected static ?string $model = Caixa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('tipo_transacao')
                    ->label('Tipo de Transação')
                    ->options([
                        'entrada' => 'Entrada',
                        'saida' => 'Saída',
                    ])
                    ->required(),

                TextInput::make('valor_transacao')
                    ->label('Valor')
                    ->numeric()
                    ->required(),

                Select::make('id_pagamento')
                    ->label('Pagamento')
                    ->relationship('pagamento', 'id_pagamento')
                    ->searchable()
                    ->required(),

                DateTimePicker::make('data_transacao')
                    ->label('Data da Transação')
                    ->default(now())
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tipo_transacao')->label('Tipo'),
                TextColumn::make('valor_transacao')->money('BRL'),
                TextColumn::make('pagamento.id_pagamento')->label('ID Pagamento'),
                TextColumn::make('data_transacao')->dateTime('d/m/Y H:i'),
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
            'index' => Pages\ListCaixas::route('/'),
            'create' => Pages\CreateCaixa::route('/create'),
            'edit' => Pages\EditCaixa::route('/{record}/edit'),
        ];
    }
}
