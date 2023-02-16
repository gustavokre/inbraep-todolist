<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarefas_prioridade', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ds_prioridade');
            $table->integer('or_prioridade')->unique();
        });

        \App\Models\TarefasPrioridade::insert(
            [
                ["ds_prioridade" => "Máxima", "or_prioridade" => 1],
                ["ds_prioridade" => "Alta", "or_prioridade" => 2],
                ["ds_prioridade" => "Média", "or_prioridade" => 3],
                ["ds_prioridade" => "Baixa", "or_prioridade" => 4],

            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
