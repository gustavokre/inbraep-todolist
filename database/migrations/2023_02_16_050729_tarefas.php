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
        Schema::create('tarefas', function (Blueprint $table) {
            $table->increments('id');

            //chaves estrangeiras
            $table->integer('cd_tarefa_progresso')->unsigned();
            $table->integer('cd_tarefa_prioridade')->unsigned();
            $table->integer('cd_pessoa_atribuido')->unsigned()->nullable();
            $table->integer('cd_pessoa_requerente')->unsigned();

            $table->string('ds_titulo');
            $table->dateTime('dt_criado');
            $table->dateTime('dt_previsao')->nullable();
            $table->boolean('fl_delete')->default(false);


            $table->foreign('cd_tarefa_progresso')
                ->references('id')
                ->on('tarefas_progresso')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('cd_tarefa_prioridade')
                ->references('id')
                ->on('tarefas_prioridade')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('cd_pessoa_atribuido')
                ->references('id')
                ->on('pessoas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('cd_pessoa_requerente')
                ->references('id')
                ->on('pessoas')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
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
