<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

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

    //override para ficar na timezone correta
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function pessoa(){
        return $this->hasOne(Pessoas::class, 'id','cd_pessoa');
    }
}
