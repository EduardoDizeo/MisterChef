<?php

namespace Database\Seeders;

use App\Models\PagoProveedor;
use App\Models\User;
use App\Models\Cliente;
use App\Models\Vendedor;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Compra;
use App\Models\Factura;
use App\Models\DetalleFactura;
use App\Models\DetalleCompra;
use App\Models\Pago;
use App\Models\CarteraCliente;
use App\Models\CarteraProveedor;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuario administrador
        User::create([
            'name' => 'Eduardo Gutierrez de Piñerez',
            'email' => 'edojose1518@gmail.com',
            'password' => bcrypt('ripazha02'),
        ]);

        User::create([
            'name' => 'Luisa Fernanda Ovallos',
            'email' => 'lfovallosc@ufpso.edu.co',
            'password' => bcrypt('02062024'),
        ]);

        // Crear datos de prueba
        User::factory(5)->create();
        Cliente::factory(20)->create();
        Vendedor::factory(5)->create();
        Proveedor::factory(10)->create();
        Producto::factory(50)->create();

        Compra::factory(15)
            ->has(DetalleCompra::factory()->count(3), 'detallesCompra') 
            ->create();

        Factura::factory(30)
            ->has(DetalleFactura::factory()->count(4), 'detallesFactura')
            ->create();

        Pago::factory(20)->create();
        PagoProveedor::factory(20)->create();
        CarteraCliente::factory(15)->create();
        CarteraProveedor::factory(10)->create();
    }
}