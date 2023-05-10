<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('work_absences', function (Blueprint $table) {
            $table->id();
            $table->text('lack')->comment('Falta');
            $table->text('sanction')->comment('Sanción');
            $table->text('description')->comment('Descripción de la Falta');
            $table->date('due_date')->nullable()->comment('Fecha de Vencimiento');
            $table->foreignId('user_id')->comment('Usuario Relacionado')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_absences');
    }
};
