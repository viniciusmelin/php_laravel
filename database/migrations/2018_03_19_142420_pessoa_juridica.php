<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PessoaJuridica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /**
     * CNPJ
     * Razão social
     * Nome fantasia
     */
    public function up()
    {
        Schema::create('pessoa_juridica', function (Blueprint $table) {
            $table->integer('pessoa_id')->unsigned();
            $table->string('razao_social',50);
            $table->string('nome_fantasia',50);
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
        Schema::dropIfExists('pessoa_juridica');
    }
}
