<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarteraClienteFactory extends Factory
{
    public function definition()
    {
        return [
            'factura_id' => \App\Models\Factura::inRandomOrder()->first()->id,
            'saldo_pendiente' => $this->faker->randomFloat(2, 100, 5000),
            'estado' => $this->faker->boolean(),
        ];
    }
}