<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TarefasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/tarefas-get', [TarefasController::class, 'getTarefas']);
Route::post('/tarefas-progresso-get', [TarefasController::class, 'getTarefasProgresso']);
Route::post('/tarefas-prioridade-get', [TarefasController::class, 'getTarefasPrioridade']);
Route::post('/pessoas-get', [TarefasController::class, 'getPessoas']);

Route::post('/mensagem/{id}', [TarefasController::class, 'getMensagem']);
Route::post('/mensagem/salvar', [TarefasController::class, 'salvarMensagem']);

//CRUD, pegar tarefa unica / criar nova tarefa / deletar tarefa
Route::apiResource('tarefas', TarefasController::class);

