<?php

use App\Http\Controllers\ChamadoController;
use App\Http\Controllers\painelPublico\ConsultaPublicaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/consultas', [ConsultaPublicaController::class, 'index'])
    ->name('consulta_publica');
    // routes/web.php
Route::get('/chamados', [ChamadoController::class, 'index']);


require __DIR__.'/auth.php';
