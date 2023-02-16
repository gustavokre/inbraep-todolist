<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoas extends Model
{
    use HasFactory;

    protected $table = 'pessoas';

    protected $fillable = [
        'id',
        'ds_nome',
        'ds_cpf',
        'ds_email',
        'dt_nascimento'
    ];
}
