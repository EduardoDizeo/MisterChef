<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Proveedor;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Compra;
use App\Models\CarteraProveedor;
use App\Models\CarteraCliente;
use App\Models\Pago;


class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
         return view('home', [
        'clientes' => Cliente::count(),
        'proveedores' => Proveedor::count(),
        'facturas' => Factura::count(),
        'productos' => Producto::count(),
        'compras' => Compra::count(),
        'carteraProveedores' => CarteraProveedor::count(),
        'carteraClientes' => CarteraCliente::count(),
        'pagos' => Pago::count(),
    ]);
    }
}
