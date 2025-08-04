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
    Schema::create('solicitudes', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('apellido');
        $table->string('monitor');
        $table->string('cpu');
        $table->string('mainboard');
        $table->string('disco_duro');
        $table->string('memoria_ram');
        $table->string('otros')->nullable();
        $table->enum('estado', ['Pendiente', 'Aprobado', 'Negado'])->default('Pendiente');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitudes');
    }
};
