<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultaResource\Pages;
use App\Filament\Resources\ConsultaResource\RelationManagers;
use App\Models\Consulta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;




class ConsultaResource extends Resource
{
    protected static ?string $model = Consulta::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
        
        Select::make('medico_id')
        ->default(fn () => auth()->user()->medico->id) // pega o médico do login
        ->hidden() // esconde do formulário
        ->required(),

        Select::make('procedimento_id')
            ->label('Procedimento')
            ->relationship('procedimento', 'nome')
            ->required(),

        TextInput::make('paciente')
            ->label('Paciente')
            ->placeholder('Opcional')
            ->nullable(),

        DatePicker::make('data')
            ->label('Data da Consulta')
            ->required(),

        TextInput::make('valor') 
            ->label('Valor')
            ->numeric()
            ->required(),
    ]);

    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('medico.nome')->label('Médico'),
            TextColumn::make('procedimento.nome')->label('Procedimento'),
            TextColumn::make('paciente')->label('Paciente'),
            TextColumn::make('data')->date()->label('Data'),
            TextColumn::make('valor')->money('BRL', true)->label('Valor'),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListConsultas::route('/'),
            'create' => Pages\CreateConsulta::route('/create'),
            'edit' => Pages\EditConsulta::route('/{record}/edit'),
        ];
    }
}
