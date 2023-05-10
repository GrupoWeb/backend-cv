<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('date_of_admission')->nullable()->comment('Fecha de Ingreso');
            $table->string('bank_account')->nullable()->comment('Cuenta Bancaria');
            $table->string('account_name')->nullable()->comment('Nombre Cuenta');
            $table->string('license_number')->nullable()->comment('Número de Licencia');
            $table->string('scholarship')->nullable()->comment('Escolaridad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
