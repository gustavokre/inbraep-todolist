<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarefasPrioridade extends Model
{
    use HasFactory;

    protected $table = 'tarefas_prioridade';

    protected $fillable = [
        'id',
        'ds_prioridade',
        'or_prioridade',
    ];
}
