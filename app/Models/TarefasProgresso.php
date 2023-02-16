<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarefasProgresso extends Model
{
    use HasFactory;

    protected $table = 'tarefas_progresso';

    protected $fillable = [
        'id',
        'ds_progresso',
        'ordem',
    ];
}
