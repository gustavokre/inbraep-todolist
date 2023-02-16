<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('tarefas_mensagem', function (Blueprint $table) {
            $table->increments('id');

            //chaves estrangeiras
            $table->integer('cd_tarefa')->unsigned();
            $table->integer('cd_pessoa')->unsigned();

            $table->text('ds_mensagem');
            $table->timestamps();

            $table->foreign('cd_tarefa')
                ->references('id')
                ->on('tarefas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('cd_pessoa')
                ->references('id')
                ->on('pessoas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }


    public function down()
    {
        //
    }
};
