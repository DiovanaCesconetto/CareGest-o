<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChamadoController extends Controller
{
 public function index()
    {
$arquivo = storage_path('app/chamados_solus_20250922.csv');

if (($handle = fopen($arquivo, 'r')) !== false) {
    $cabecalho = fgetcsv($handle, 1000, ";");
    $pendentes = 0;

    while (($dados = fgetcsv($handle, 1000, ";")) !== false) {
        $chamado = array_combine($cabecalho, $dados);

        // Corrigido para maiúsculo e ignorando colunas vazias
      if (isset($chamado['STATUS']) && strcasecmp(trim($chamado['STATUS']), 'Esperando seu retorno') === 0) {
    $pendentes++;

        }
    }

    fclose($handle);

    echo "Total de chamados pendentes: $pendentes";
}}}