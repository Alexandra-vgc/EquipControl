Schema::create('devoluciones', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users'); // usuario que devuelve
    $table->foreignId('equipo_id')->constrained('equipos'); // equipo devuelto
    $table->date('fecha_devolucion');
    $table->text('observaciones')->nullable();
    $table->timestamps();
});
