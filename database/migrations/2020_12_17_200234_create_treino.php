<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreino extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treino', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_aluno')->unsigned();
            $table->foreign('id_aluno')->references('id')->on('aluno')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('id_exercicio')->unsigned();
            $table->foreign('id_exercicio')->references('id')->on('exercicio')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('status');
            $table->string('sessao');
            $table->boolean('ativo');
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venda');
    }
}
