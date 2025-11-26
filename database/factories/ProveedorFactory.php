<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{
    public function definition()
    {
        return [
            'nombre' => $this->faker->company,
            'telefono' => $this->faker->phoneNumber,
            'correo_electronico' => $this->faker->unique()->companyEmail,
            'direccion' => $this->faker->address,
            'estado' => $this->faker->boolean(),
            'registrado_por' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}