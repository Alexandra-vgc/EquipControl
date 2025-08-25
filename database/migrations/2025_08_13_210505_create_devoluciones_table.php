<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('devoluciones', function (Blueprint $table) {
            $table->string('entrega_nombre')->nullable();
            $table->string('entrega_cc')->nullable();
            $table->string('recibe_nombre')->nullable();
            $table->string('recibe_cc')->nullable();
            $table->json('verificacion')->nullable();
            $table->json('accesorios')->nullable();
            $table->string('evidencia_path')->nullable();
            $table->string('firma_entrega_path')->nullable();
            $table->string('firma_recibe_path')->nullable();
            $table->string('pdf_path')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('devoluciones', function (Blueprint $table) {
            $table->dropColumn([
                'entrega_nombre',
                'entrega_cc',
                'recibe_nombre',
                'recibe_cc',
                'verificacion',
                'accesorios',
                'evidencia_path',
                'firma_entrega_path',
                'firma_recibe_path',
                'pdf_path',
                'created_by'
            ]);
        });
    }
};