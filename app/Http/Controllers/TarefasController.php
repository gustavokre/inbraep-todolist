<?php

namespace App\Http\Controllers;

use App\Models\Pessoas;
use App\Models\Tarefas;
use App\Models\TarefasMensagem;
use App\Models\TarefasPrioridade;
use App\Models\TarefasProgresso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TarefasController extends Controller
{
    public function salvarMensagem(Request $request){

        try {

            $validator = Validator::make($request->all(),
                [
                    'ds_mensagem' => 'required|string',
                    'cd_pessoa' => 'required|integer',
                ]
            );

            if($validator->fails()){
                return response()->json(["errors" => ["Favor preencher corretamente os campos"]], 400);
            }

            $mensagem = new TarefasMensagem($request->all());
            $mensagem->save();

            return response()->json(["message" => ["Mensagem salva com sucesso"]], 200);

        } catch (\Throwable $e) {
            log::error($e->getMessage());
            return response()->json(["errors" => ["Não foi possível salvar sua mensagem"]], 500);
        }

    }

    public function getTarefasProgresso(Request $request){

        return response()->json(TarefasProgresso::all(), 200);

    }

    public function getTarefasPrioridade(Request $request){

        //keyby or_prioridade para facilitar o front-end
        $tarefas_prioridade = TarefasPrioridade::all()->keyby('or_prioridade');

        return response()->json($tarefas_prioridade, 200);


    }

    public function getTarefas(Request $request) {


        $tarefas = Tarefas::where('fl_delete', false)
            ->with('prioridade')
            ->get()
            //ordena as tarefas por prioridade
            ->sortBy(function($query){

                return $query->prioridade->or_prioridade;

            })
            //groupby cd_tarefa_progresso para facilitar o front-end
            ->groupBy('cd_tarefa_progresso');

        return response()->json($tarefas, 200);

    }

    public function getPessoas(Request $request){

        return response()->json(Pessoas::all(), 200);
    }

    public function getMensagem(Request $request, $id){

        $tarefa_mensagem = Tarefas::with('mensagens')->find($id);

        return response()->json($tarefa_mensagem, 200);
    }

    public function store(Request $request){
        try {

            $validator = Validator::make($request->all(),
                [
                    'cd_tarefa_progresso' => 'required|integer',
                    'cd_tarefa_prioridade' => 'required|integer',
                    'cd_pessoa_requerente' => 'required|integer',
                    'ds_titulo' => 'required'
                ]
            );

            if($validator->fails()){
                return response()->json(["errors" => ["Favor preencher corretamente os campos"]], 400);
            }

            DB::beginTransaction();

            $tarefa = new Tarefas($request->all());
            $tarefa->save();

            if(!empty($request->ds_mensagem)){
                $mensagem = new TarefasMensagem();
                $mensagem->cd_pessoa = $request->cd_pessoa_requerente;
                $mensagem->ds_mensagem = $request->ds_mensagem;
                $mensagem->cd_tarefa = $tarefa->id;
                $mensagem->save();
            }


            DB::commit();

        } catch (\Throwable $e) {

            log::error($e->getMessage());
            DB::rollBack();
            return response()->json(["errors" => ["Não foi possível criar a tarefa"]], 500);
        }
    }

    public function update(Request $request, Tarefas $tarefa){
        try {

            $tarefa->update($request->all());

        } catch (\Throwable $e) {

            log::error($e->getMessage());
            return response()->json(["errors" => ["Não foi possível atualizar esta tarefa"]], 500);
        }
    }

    public function destroy(Tarefas $tarefa){
        try {

            $tarefa->fl_delete = true;
            $tarefa->save();

            return response()->json(["message" => ["Tarefa removida"]], 200);

        } catch (\Throwable $e) {

            log::error($e->getMessage());
            return response()->json(["errors" => ["Não foi possível excluir esta tarefa"]], 500);
        }
    }
}
