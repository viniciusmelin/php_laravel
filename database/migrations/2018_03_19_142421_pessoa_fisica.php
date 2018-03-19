<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PessoaFisica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**
     * Pessoa física:
     * CPF
     * Data de nascimento
     * Nome
     * Sobrenome (15 caracteres)
     * CEP (8 caracteres)
     * Logradouro
     * Número
     * Complemento
     * Bairro
     * Cidade
     * UF (8 caracteres)
     */
    public function up()
    {
        Schema::create('pessoa_fisica', function (Blueprint $table) {
            $table->integer('pessoa_id')->unsigned();
            $table->date('data_nascimento');
            $table->string('nome',50);
            $table->string('sobrenome',15);
            $table->timestamps();
            $table->foreign('pessoa_id')->references('id')->on('pessoa')->onDelete('cascade');
            $table->primary('pessoa_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoa_fisica');
    }
}
