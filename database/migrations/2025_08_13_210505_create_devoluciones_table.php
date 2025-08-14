<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('devoluciones', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('equipo_id');
        $table->date('fecha_devolucion');
        $table->string('observaciones')->nullable();
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('devoluciones');
    }
};
