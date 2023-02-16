<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarefasMensagem extends Model
{
    use HasFactory;

    protected $table = 'tarefas_mensagem';

    protected $fillable = [
        'id',
        'cd_tarefa',
        'cd_pessoa',
        'ds_mensagem',
    ];
}
