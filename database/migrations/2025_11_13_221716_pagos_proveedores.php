<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pagos_proveedores', function (Blueprint $table) {
            $table->id();

            $table->foreignId('compra_id')->constrained('compras');
            $table->foreignId('proveedor_id')->constrained('proveedores');

            $table->decimal('monto_pago', 10, 2);
            $table->dateTime('fecha_pago');

            $table->string('metodo_pago')->nullable();

            $table->foreignId('registrado_por')->constrained('users');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pagos_proveedores');
    }
};
