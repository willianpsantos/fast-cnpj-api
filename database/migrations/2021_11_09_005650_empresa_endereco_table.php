<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpresaEnderecoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_endereco', function(Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->unsignedBigInteger('empresa_id')->nullable(false);
            $table->string('cep', 10)->nullable();
            $table->string('logradouro', 255)->nullable();
            $table->string('codigo_ibge', 10)->nullable();
            $table->string('cidade', 255)->nullable();
            $table->string('estado', 2)->nullable();
            $table->string('bairro', 255)->nullable();
            $table->string('numero', 100)->nullable();
            $table->string('pais', 150)->nullable();
            $table->string('complemento', 255)->nullable();
            $table->timestamps();

            $table
                ->foreign('empresa_id')
                ->references('id')
                ->on('empresa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_endereco');
    }
}
