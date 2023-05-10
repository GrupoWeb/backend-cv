<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('money_loans', function (Blueprint $table) {
            $table->id();
            $table->text('description')->comment('Descripción del Préstamo');
            $table->decimal('loan_amount',8,2)->comment('Cantidad Préstamo');
            $table->foreignId('user_id')->comment('Usuario Relacionado')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('money_loans');
    }
};
