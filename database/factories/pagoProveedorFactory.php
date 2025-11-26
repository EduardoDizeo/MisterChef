<?php

namespace Database\Factories;

use App\Models\PagoProveedor;
use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PagoProveedorFactory extends Factory
{
    protected $model = PagoProveedor::class;

    public function definition()
    {
        // Seleccionar una compra aleatoria
        $compra = Compra::inRandomOrder()->first();

        // Si la compra existe, tomamos su proveedor
        $proveedorId = $compra ? $compra->proveedor_id : Proveedor::inRandomOrder()->first()->id;

        return [
            'compra_id'      => $compra ? $compra->id : Compra::factory(),
            'proveedor_id'   => $proveedorId,

            'monto_pago'     => $this->faker->randomFloat(2, 10, 2000),
            'fecha_pago'     => $this->faker->dateTimeThisYear(),
            'metodo_pago'    => $this->faker->randomElement(['Efectivo', 'Transferencia', 'Cheque', 'Nequi', 'Bancolombia']),
            'registrado_por' => User::inRandomOrder()->first()->id,
        ];
    }
}
