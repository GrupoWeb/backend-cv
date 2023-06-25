<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cuentas_corrientes', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->string('codigo')->nullable()->comment('Código');
            $table->text('title')->comment('Título');
            $table->integer('nivel')->nullable();
            $table->boolean('principal')->default(false);
            $table->string('estilo')->nullable()->comment('Estilo');


            $table->unsignedBigInteger('parent_id')->nullable()->comment('Relación de cuenta Padre');
            $table->unsignedBigInteger('grandparent_id')->nullable()->comment('Relación de cuenta Abuelo');
            $table->unsignedBigInteger('great_grandparent_id')->nullable()->comment('Relación de cuenta Bisabuelo');
            $table->unsignedBigInteger('great_great_grandparent_id')->nullable()->comment('Relación de cuenta Tatarabuelo');
            $table->unsignedBigInteger('great_great_great_grandparent_id')->nullable()->comment('Relación de cuenta Tatarabuelo');

            $table->foreign('parent_id')->references('id')->on('cuentas_corrientes');
            $table->foreign('grandparent_id')->references('id')->on('cuentas_corrientes');
            $table->foreign('great_grandparent_id')->references('id')->on('cuentas_corrientes');
            $table->foreign('great_great_grandparent_id')->references('id')->on('cuentas_corrientes');
            $table->foreign('great_great_great_grandparent_id')->references('id')->on('cuentas_corrientes');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cuentas_corrientes');
    }
};
