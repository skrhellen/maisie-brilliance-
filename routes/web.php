<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JoiaController;
use App\Http\Controllers\VendasController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\EstoqueController;
/*
Route::get('/', function () {
     return view('welcome');
});
*/
Route::get('/', [JoiaController::class, 'indexPrincipal'])->name('joia.indexPrincipal');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/joia/search', [JoiaController::class, "search"])->name('joia.search'); 
    Route::get('/joia/chart', [JoiaController::class, "chart"])->name('joia.chart'); 
    Route::resource('joia', JoiaController::class); 

    Route::post('/vendas/search', [VendasController::class, "search"])->name('vendas.search');
    Route::get('/vendas/chart', [VendasController::class, "chart"])->name('vendas.chart');
    Route::resource('vendas', VendasController::class);

    Route::resource('marca', MarcaController::class);
    Route::post('/marca/search', [MarcaController::class, "search"])->name('marca.search');

    Route::post('/clientes/search', [ClientesController::class, "search"])->name('clientes.search');
    Route::get('/clientes/report/', [ClientesController::class, "report"])->name('clientes.report');
    Route::resource('clientes', ClientesController::class);
    
    Route::post('/estoque/search', [EstoqueController::class, "search"])->name('estoque.search');
    Route::get('/estoque/report/', [EstoqueController::class, "report"])->name('estoque.report');
    Route::resource('estoque', EstoqueController::class);
});

require __DIR__.'/auth.php';