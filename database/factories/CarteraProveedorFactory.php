<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CarteraProveedorFactory extends Factory
{
    public function definition()
    {
        return [
            'compra_id' => \App\Models\Compra::inRandomOrder()->first()->id,
            'saldo_pendiente' => $this->faker->randomFloat(2, 100, 10000),
            'estado' => $this->faker->boolean(),
        ];
    }
}