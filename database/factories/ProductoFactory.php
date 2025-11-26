<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    public function definition()
    {
        return [
            'proveedor_id' => \App\Models\Proveedor::inRandomOrder()->first()->id,
            'nombre' => $this->faker->word,
            'gramaje' => $this->faker->randomFloat(2, 0.1, 1000),
            'precio_compra' => $this->faker->randomFloat(2, 1, 100),
            'precio_venta' => $this->faker->randomFloat(2, 1.5, 150),
            'stockActual' => $this->faker->numberBetween(0, 500),
            'stockMinimo' => 10,
            'estado' => $this->faker->boolean(),
            'registrado_por' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}