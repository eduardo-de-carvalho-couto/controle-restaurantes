<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MesaResource\Pages;
use App\Models\Mesa;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class MesaResource extends Resource
{
    protected static ?string $model = Mesa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nome_cliente')
                    ->label('Nome do Cliente')
                    ->required()
                    ->maxLength(80),

                TextInput::make('numero_mesa')
                    ->label('Número da Mesa')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->maxValue(99),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id_cliente')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nome_cliente')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('numero_mesa')
                    ->label('Mesa')
                    ->sortable(),
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
            'index' => Pages\ManageMesas::route('/'),
        ];
    }
}
