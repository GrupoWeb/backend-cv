<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('cuentas_corrientes', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->text('title')->comment('Título');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('Relación de cuenta Padre');
            $table->foreign('parent_id')->references('id')->on('cuentas_corrientes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cuentas_corrientes');
    }
};
