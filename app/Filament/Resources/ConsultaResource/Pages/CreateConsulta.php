<?php

namespace App\Filament\Resources\ConsultaResource\Pages;

use App\Filament\Resources\ConsultaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateConsulta extends CreateRecord
{
    protected static string $resource = ConsultaResource::class;

protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['medico_id'] = auth()->user()?->medico?->id;
    
    if (!$data['medico_id']) {
        throw new \Exception('O usuário logado não tem um médico vinculado.');
    }

    return $data;
}
}