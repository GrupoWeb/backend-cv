<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('familia', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->text('full_name')->comment('Nombre Completo');
            $table->string('gender',2)->comment('Género');
            $table->date('date_of_birth')->nullable()->comment('Fecha de Nacimiento');
            $table->foreignId('user_id')->comment('Usuario Relacionado')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('familia');
    }
};
