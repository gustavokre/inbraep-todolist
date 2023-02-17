<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TarefasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('{any}', 'welcome')->where('any', '.*');

Route::prefix('api')->group(function () {


    Route::post('/tarefas-get', [TarefasController::class, 'getTarefas']);
    Route::post('/tarefas-progresso-get', [TarefasController::class, 'getTarefasProgresso']);
    Route::post('/tarefas-prioridade-get', [TarefasController::class, 'getTarefasPrioridade']);



});
