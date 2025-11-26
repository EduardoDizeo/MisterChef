<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VendedorFactory extends Factory
{
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'telefono' => $this->faker->phoneNumber,
            'correo_electronico' => $this->faker->unique()->safeEmail,
            'fecha_registro' => $this->faker->dateTimeThisYear,
            'estado' => $this->faker->boolean(), // 90% de probabilidad de estar activo
            'registrado_por' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}