<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->dateTime('fecha');
            $table->decimal('total', 10, 2);
            $table->boolean('estado')->default(true);
            $table->foreignId('registrado_por')->constrained('users')->change();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('facturas');
    }
};