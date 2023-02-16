<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ds_nome');
            $table->string('ds_email');
            $table->date('dt_nascimento');
            $table->timestamps();
        });

        \App\Models\Pessoas::insert(
            [
                ["ds_nome" => "Mário Gustavo Kreibich", "ds_email" => "gukre92@gmail.com", "dt_nascimento" => "1992-10-26"],
                ["ds_nome" => "Júlio Cesar", "ds_email" => "julio.cesar@gmail.com", "dt_nascimento" => "1995-11-21"],
                ["ds_nome" => "Marly Medeiros", "ds_email" => "marly.medeiros@gmail.com", "dt_nascimento" => "1972-03-09"],
                ["ds_nome" => "Carlos Augusto", "ds_email" => "carlos.augusto@gmail.com", "dt_nascimento" => "2001-05-14"],
            ]
        );

    }

    public function down()
    {
        //
    }
};
