<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('factura_id')->constrained('facturas');
            $table->foreignId('cliente_id')->constrained('clientes'); // ← AGREGADO
            $table->decimal('monto_pago', 10, 2);
            $table->dateTime('fecha_pago');
            $table->string('metodo_pago'); // ← Te falta esta columna en la migración
            $table->boolean('estado')->default(true);
            $table->foreignId('registrado_por')->constrained('users');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('pagos');
    }
};