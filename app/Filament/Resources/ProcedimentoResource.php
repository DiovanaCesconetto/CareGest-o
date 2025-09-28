<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProcedimentoResource\Pages;
use App\Filament\Resources\ProcedimentoResource\RelationManagers;
use App\Models\Procedimento;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;



class ProcedimentoResource extends Resource
{
    protected static ?string $model = Procedimento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
         return $form->schema([
        TextInput::make('nome')
            ->label('Nome do Procedimento')
            ->required(),

        TextInput::make('valor')
            ->label('Valor (R$)')
            ->numeric()
            ->required(),

        TextInput::make('duracao')
            ->label('Duração (minutos)')
            ->numeric()
            ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
                ->columns([
            TextColumn::make('nome')->label('Procedimento'),
            TextColumn::make('valor')->money('BRL', true)->label('Valor'),
            TextColumn::make('duracao')->label('Duração (min)'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListProcedimentos::route('/'),
            'create' => Pages\CreateProcedimento::route('/create'),
            'edit' => Pages\EditProcedimento::route('/{record}/edit'),
        ];
    }
    public static function shouldRegisterNavigation(): bool
{
    // Só admins podem ver médicos e procedimentos
    return auth()->user()->isAdmin();
}
}
