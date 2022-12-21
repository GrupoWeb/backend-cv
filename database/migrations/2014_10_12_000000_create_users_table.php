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
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->string('name')->comment('Nombre Completo');
            $table->string('first_name')->nullable()->comment('Primer Nombre');
            $table->string('second_name')->nullable()->comment('Segundo Nombre');
            $table->string('surname')->nullable()->comment('Primer Apellido');
            $table->string('second_surname')->nullable()->comment('Segundo Apellido');
            $table->string('email')->unique()->comment('Correo Electrónico');
            $table->timestamp('email_verified_at')->nullable()->comment('Verificación de correo');
            $table->string('password')->comment('Contraseña');
            $table->bigInteger('identification')->nullable()->comment('DPI');
            $table->string('address')->nullable()->comment('Dirección');
            $table->date('date_of_birth')->nullable()->comment('Fecha de Nacimiento');
            $table->string('nit')->nullable()->comment('NIT');
            $table->string('gender',2)->nullable()->comment('Género');
            $table->string('marital_status')->nullable()->comment('Estado Civil');
            $table->boolean('igss')->nullable()->comment('IGSS');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
