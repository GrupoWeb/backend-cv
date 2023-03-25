<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('salarios', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->decimal('salary',8,2)->comment('Salario');
            $table->decimal('bonus',8,2)->comment('Bonificación 78 89');
            $table->decimal('agreed_bonus',8,2)->comment('Bono Acordado 78 89 Pactada');
            $table->foreignId('user_id')->comment('Usuario Relacionado')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('salarios');
    }
};
