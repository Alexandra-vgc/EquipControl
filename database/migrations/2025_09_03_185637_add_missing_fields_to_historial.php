<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('historial', function (Blueprint $table) {
            if (!Schema::hasColumn('historial', 'ip')) {
                $table->string('ip')->nullable()->after('observaciones');
            }
            if (!Schema::hasColumn('historial', 'ruta')) {
                $table->string('ruta')->nullable()->after('ip');
            }
            if (!Schema::hasColumn('historial', 'metadata')) {
                $table->json('metadata')->nullable()->after('ruta');
            }
        });
    }

    public function down()
    {
        Schema::table('historial', function (Blueprint $table) {
            if (Schema::hasColumn('historial', 'ip')) {
                $table->dropColumn('ip');
            }
            if (Schema::hasColumn('historial', 'ruta')) {
                $table->dropColumn('ruta');
            }
            if (Schema::hasColumn('historial', 'metadata')) {
                $table->dropColumn('metadata');
            }
        });
    }
};
