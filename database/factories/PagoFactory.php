<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Factura;
use App\Models\User;

class PagoFactory extends Factory
{
    public function definition()
    {
        // Obtener una factura aleatoria existente
        $factura = Factura::inRandomOrder()->first();

        return [
            'factura_id'    => $factura->id,
            'cliente_id'    => $factura->cliente_id, // ← AGREGADO
            'monto_pago'    => $this->faker->randomFloat(2, 10, $factura->total),
            'fecha_pago'    => $this->faker->dateTimeThisMonth(),
            'metodo_pago'   => $this->faker->randomElement(['Efectivo', 'Transferencia']), // ← AGREGADO
            'estado'        => $this->faker->boolean(),
            'registrado_por'=> User::inRandomOrder()->first()->id,
        ];
    }
}
