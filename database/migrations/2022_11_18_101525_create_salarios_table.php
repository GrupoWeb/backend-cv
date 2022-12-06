<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('salarios', function (Blueprint $table) {
            $table->id();
            $table->decimal('salary',8,2);
            $table->decimal('bonus',8,2);
            $table->decimal('agreed_bonus',8,2);
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('salarios');
    }
};
