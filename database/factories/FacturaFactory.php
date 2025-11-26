<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FacturaFactory extends Factory
{
    public function definition()
    {
        return [
            'cliente_id' => \App\Models\Cliente::inRandomOrder()->first()->id,
            'fecha' => $this->faker->dateTimeThisMonth,
            'total' => $this->faker->randomFloat(2, 50, 5000),
            'estado' => $this->faker->boolean(),
            'registrado_por' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}