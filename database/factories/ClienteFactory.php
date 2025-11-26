<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    public function definition()
    {
        return [
            'nombre' => $this->faker->name,
            'telefono' => $this->faker->phoneNumber,
            'direccion' => $this->faker->address,
            'nit' => $this->faker->unique()->numerify('###########'),
            'correo_electronico' => $this->faker->unique()->safeEmail,
            'estado' => $this->faker->boolean(),
            'registrado_por' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}