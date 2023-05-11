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

        Schema::table('work_absences', function (Blueprint $table) {
            $table->dropColumn('lack');
            $table->dropColumn('sanction');
        });


        Schema::table('work_absences', function (Blueprint $table) {
            $table->foreignId('faltas_id')->comment('Falta')->constrained()->after('id');
            $table->foreignId('sanciones_id')->comment('Sanción')->constrained()->after('id');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work_absences', function (Blueprint $table) {
            //
        });
    }
};
