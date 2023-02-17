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
        Schema::table('tarefas_prioridade', function (Blueprint $table) {

            $table->string('ds_color_hex', 7)->default('#22dd22');

        });

        \App\Models\TarefasPrioridade::where('or_prioridade', 1)->update(['ds_color_hex' => '#e00f00']);
        \App\Models\TarefasPrioridade::where('or_prioridade', 2)->update(['ds_color_hex' => '#e06900']);
        \App\Models\TarefasPrioridade::where('or_prioridade', 3)->update(['ds_color_hex' => '#f7e307']);
        \App\Models\TarefasPrioridade::where('or_prioridade', 4)->update(['ds_color_hex' => '#8ff707']);

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
