<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarefasProgresso extends Model
{
    use HasFactory;

    protected $table = 'tarefas_progresso';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'ds_progresso',
        'ds_color_hex',
        'ordem',
    ];

    public function tarefas(){
        return $this->hasMany(Tarefas::class, 'cd_tarefa_progresso','id')->with('prioridade');
    }
}
