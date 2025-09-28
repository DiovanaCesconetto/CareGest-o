<?php

namespace App\Http\Controllers\painelPublico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Medico;

class ConsultaPublicaController extends Controller
{

    public function index(Request $request){

       $query = Medico::query();

        // Filtrar por busca (nome ou especialidade)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('nome', 'like', "%{$search}%")
                  ->orWhere('especialidade', 'like', "%{$search}%");
        }

        $medicos = $query->get();

        return view('medicos.publicos', compact('medicos'));



}
}
