<?php
/**
 * autor angelitooDev
 * Migration para crear la tabla products
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Crea la tabla products con las columnas necesarias.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            // type puede tomar valores: Armas cortas, Cuchillos, Armas largas
            $table->enum('type', ['Armas cortas', 'Cuchillos', 'Armas largas']);
            $table->string('name');             // Nombre del producto
            $table->string('description');      // Descripcion del producto
            $table->unsignedInteger('stock');   // Cantidad en inventario
            // weight y image pueden ser nulos
            $table->decimal('weight', 8, 2)->nullable();
            $table->string('image')->nullable();
            // timestamps agrega las columnas created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Elimina la tabla products en caso de rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
