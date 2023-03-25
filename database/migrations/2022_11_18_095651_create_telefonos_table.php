<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('telefonos', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->integer('number')->comment('Número');
            $table->foreignId('tipo_telefono_id')->comment('Tipo de Teléfono')->constrained();
            $table->foreignId('user_id')->comment('usuario Relacionado')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('telefonos');
    }
};
