<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleCompraFactory extends Factory
{
    public function definition()
    {
        return [
            'compra_id' => \App\Models\Compra::inRandomOrder()->first()->id,
            'producto_id' => \App\Models\Producto::inRandomOrder()->first()->id,
            'cantidad' => $this->faker->numberBetween(1, 100),
            'precio_unitario' => $this->faker->randomFloat(2, 1, 500),
            'subtotal' => function (array $attributes) {
                return $attributes['cantidad'] * $attributes['precio_unitario'];
            },
        ];
    }
}