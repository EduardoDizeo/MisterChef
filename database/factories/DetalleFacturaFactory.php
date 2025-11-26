<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleFacturaFactory extends Factory
{
    public function definition()
    {
        return [
            'factura_id' => \App\Models\Factura::inRandomOrder()->first()->id,
            'producto_id' => \App\Models\Producto::inRandomOrder()->first()->id,
            'cantidad_producto' => $this->faker->numberBetween(1, 50),
            'precio_unitario' => $this->faker->randomFloat(2, 1, 1000),
            'subtotal' => function (array $attributes) {
                return $attributes['cantidad_producto'] * $attributes['precio_unitario'];
            },
        ];
    }
}