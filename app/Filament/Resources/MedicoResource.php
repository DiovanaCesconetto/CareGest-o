<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MedicoResource\Pages;
use App\Filament\Resources\MedicoResource\RelationManagers;
use App\Models\Medico;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
//use Filament\Tables\Columns\FileUpload;
use Filament\Forms\Components\FileUpload;




class MedicoResource extends Resource
{
    protected static ?string $model = Medico::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
   {
        return $form
            ->schema([
                TextInput::make('nome')
                    ->label('Nome')
                    ->required()
                    ->maxLength(255),
                TextInput::make('crm')
                    ->label('CRM')
                    ->required()
                    ->maxLength(20),
                TextInput::make('email')
                    ->label('email')
                    ->required()
                    ->maxLength(20),
                TextInput::make('especialidade')
                    ->label('Especialidade')
                    ->required()
                    ->maxLength(100),
                Textarea::make('observacoes')
                    ->label('Observações')
                    ->maxLength(500),
                TextInput::make('whatsapp')
                    ->tel()
                    ->required()
                    ->mask('(99) 99999-9999') // máscara
                    ->placeholder('(69) 99999-9999'),
              FileUpload::make('foto')
                    ->image()
                    ->disk('public')
                    ->directory('fotos-medicos')
                    ->required(fn ($record) => !$record)
                    ->maxSize(50 * 1024)
                    ->imagePreviewHeight('100'),

                   // ->imagePreviewHeight('100'),

                // Select::make('especialidade_id')
                //     ->relationship('especialidade', 'nome')
                //     ->multiple()
                //     ->required()
            ]);
    }

    // Tabela do painel admin
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('crm')
                    ->label('CRM')
                    ->sortable(),
                TextColumn::make('especialidade')
                    ->label('Especialidade')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('whatsapp')->label('WhatsApp'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMedicos::route('/'),
            'create' => Pages\CreateMedico::route('/create'),
            'edit' => Pages\EditMedico::route('/{record}/edit'),
        ];
    }
    public static function shouldRegisterNavigation(): bool
{
    // Só admins podem ver médicos e procedimentos
    return auth()->user()->isAdmin();
}
}
