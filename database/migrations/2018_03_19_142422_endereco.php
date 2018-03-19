<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Endereco extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endereco', function (Blueprint $table) {
            $table->integer('pessoa_id')->unsigned();
            $table->string('logradouro',50);
            $table->string('numero',10);
            $table->string('complemento',20)->nullable();
            $table->string('bairro',50);
            $table->string('cidade',30);
            $table->string('uf',8);
            $table->string('cep',8);
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
        Schema::dropIfExists('endereco');
    }
}
