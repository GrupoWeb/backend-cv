<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('faltas', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->integer('articulo_interno')->comment('Artículo Interno');
            $table->longText('description')->comment('Descripción');
            $table->string('area')->comment('Área');
            $table->string('fundamento_legal')->comment('Fundamento Legal');
            $table->string('frecuencia')->comment('Frecuencia');
            $table->string('limpia_record')->comment('Limpiar Record');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faltas');
    }
};
