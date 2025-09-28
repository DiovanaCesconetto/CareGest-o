<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login as BaseLogin;

class CustomLogin extends BaseLogin
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('email')
                    ->label('Seu E-mail')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('Sua Senha')
                    ->password()
                    ->required(),
            ]);
    }

    public function getBrandName(): string
    
    {
        // Esta linha remove o texto "Laravel" no topo
        return '';
    }

    public function getHeading(): string
    {
        // Esta linha remove o texto "Faça login"
        return '';
    }

    public function getSubmitButtonLabel(): string
    {
        return 'Login';
    }
}