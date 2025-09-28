<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    // Nome da tabela no banco (opcional, só se não seguir o padrão Laravel "medicos")
    protected $table = 'medicos';

    // Campos que podem ser preenchidos em massa (mass assignment)
    public function user()
{
    return $this->belongsTo(User::class);
}
    protected $fillable = [
        'nome',
        'especialidade',
        'whatsapp',
        'email',
        'endereco',
        'crm',
        'foto', // se for armazenar imagem do médico
        'user_id', 

    ];
}
