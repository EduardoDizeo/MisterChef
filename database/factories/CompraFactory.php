<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompraFactory extends Factory
{
    public function definition()
    {
        return [
            'proveedor_id' => \App\Models\Proveedor::inRandomOrder()->first()->id,
            'fecha_compra' => $this->faker->dateTimeThisYear,
            'total_compra' => $this->faker->randomFloat(2, 100, 10000),
            'estado' => $this->faker->boolean(),
            'registrado_por' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}