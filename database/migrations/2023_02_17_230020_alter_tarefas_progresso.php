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
        Schema::table('tarefas_progresso', function (Blueprint $table) {

            $table->string('ds_color_hex', 7)->default('#e06900');

        });

        \App\Models\TarefasProgresso::where('ordem', 1)->update(['ds_color_hex' => '#e06900']);
        \App\Models\TarefasProgresso::where('ordem', 2)->update(['ds_color_hex' => '#f7e307']);
        \App\Models\TarefasProgresso::where('ordem', 3)->update(['ds_color_hex' => '#8ff707']);

        //removendo progresso 'cancelado' para deixar o projeto um pouco mais clean
        \App\Models\TarefasProgresso::where('ordem', 4)->delete();

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
