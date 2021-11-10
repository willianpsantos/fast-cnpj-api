<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function(Blueprint $table) {
            $table->unsignedBigInteger('id', true);
            $table->string('cnpj', 14)->nullable(false)->unique();
            $table->string('razao_social', 255)->nullable(false);
            $table->string('nome_fantasia', 255)->nullable(false);
            $table->string('atividade_principal', 255)->nullable();
            $table->date('data_abertura')->nullable();
            $table->string('natureza_juridica', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}
