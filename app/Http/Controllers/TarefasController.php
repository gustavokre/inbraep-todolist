<?php

namespace App\Http\Controllers;

use App\Models\Tarefas;
use App\Models\TarefasPrioridade;
use App\Models\TarefasProgresso;
use Illuminate\Http\Request;

class TarefasController extends Controller
{
    public function getTarefasProgresso(Request $request){

        return response()->json(TarefasProgresso::all(), 200);

    }

    public function getTarefasPrioridade(Request $request){

        //keyby or_prioridade para facilitar o front-end
        $tarefas_prioridade = TarefasPrioridade::all()->keyby('or_prioridade');

        return response()->json($tarefas_prioridade, 200);


    }

    public function getTarefas(Request $request){

        //groupby cd_tarefa_progresso para facilitar o front-end
        $tarefas = Tarefas::all()->groupBy('cd_tarefa_progresso');

        return response()->json($tarefas, 200);

    }
}
