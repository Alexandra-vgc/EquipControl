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
            Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['CPU','Monitor','Teclado','Mouse']); // categoría
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('serie')->unique()->nullable();
            $table->string('codigo')->unique()->nullable(); // inventario
            $table->string('caracteristicas')->nullable(); // ej: 8GB RAM, i5 10th, 256GB SSD
            $table->enum('estado', ['Disponible','Asignado','En Reparación','Dañado'])->default('Disponible');
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
            Schema::dropIfExists('equipos');
        }
    };
