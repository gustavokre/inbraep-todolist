<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('tarefas_progresso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ds_progresso');
            $table->integer('ordem')->unique();
        });

        \App\Models\TarefasProgresso::insert(
            [
                ["ds_progresso" => "A fazer", "ordem" => 1],
                ["ds_progresso" => "Em progresso", "ordem" => 2],
                ["ds_progresso" => "Concluído", "ordem" => 3],
                ["ds_progresso" => "Cancelado", "ordem" => 4],

            ]
        );
    }

    public function down()
    {
        //
    }
};
