<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\TarefasPrioridade;

class Tarefas extends Model
{
    use HasFactory;

    protected $table = 'tarefas';

    protected $fillable = [
        'id',
        'cd_tarefa_progresso',
        'cd_tarefa_prioridade',
        'cd_pessoa_atribuido',
        'cd_pessoa_requerente',
        'ds_titulo',
        'dt_previsao',
        'fl_delete'
    ];

    public function prioridade(){
        return $this->hasOne(TarefasPrioridade::class, 'id','cd_tarefa_prioridade');
    }

    public function mensagens(){
        return $this->hasMany(TarefasMensagem::class, 'cd_tarefa', 'id')->with('pessoa');
    }
}
