<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = [
        'medico_id',
        'procedimento_id',
        'paciente',
        'data',
        'valor',
        
    ];

    // Relacionamento com Meadico
    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    // Relacionamento com Procedimento
    public function procedimento()
    {
        return $this->belongsTo(Procedimento::class);
    }
}
