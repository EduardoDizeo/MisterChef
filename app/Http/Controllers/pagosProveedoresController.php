<?php

namespace App\Http\Controllers;

use App\Models\PagoProveedor;
use App\Models\Compra;
use App\Models\CarteraProveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagosProveedoresController extends Controller
{
    public function index()
    {
        $pagos = PagoProveedor::with(['compra', 'proveedor'])->orderBy('id', 'DESC')->get();
        return view('pagosProveedores.index', compact('pagos'));
    }

    public function create()
    {
        // Solo compras pendientes en cartera
        $facturas = Compra::with(['proveedor', 'carteraProveedor'])
            ->whereHas('carteraProveedor', fn($q) => $q->where('estado', true))
            ->get();

        return view('pagosProveedores.create', compact('facturas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'compra_id'   => 'required|exists:compras,id',
            'monto_pago'  => 'required|numeric|min:1',
            'metodo_pago' => 'required|string',
        ]);

        $compra = Compra::findOrFail($request->compra_id);
        $cartera = CarteraProveedor::where('compra_id', $compra->id)->first();

        if (!$cartera) {
            return back()->with('error', 'No existe registro en cartera para esta compra.');
        }

        if ($request->monto_pago > $cartera->saldo_pendiente) {
            return back()->with('error', 'El monto supera el saldo pendiente.');
        }

        // Registrar el pago
        $pago = PagoProveedor::create([
            'compra_id'     => $compra->id,
            'proveedor_id'  => $compra->proveedor_id,
            'monto_pago'    => $request->monto_pago,
            'fecha_pago'    => now(),
            'metodo_pago'   => $request->metodo_pago,
            'registrado_por'=> Auth::id(),
        ]);

        // Descontar saldo
        $cartera->saldo_pendiente -= $request->monto_pago;

        // Cerrar cartera si llega a 0
        if ($cartera->saldo_pendiente <= 0) {
            $cartera->saldo_pendiente = 0;
            $cartera->estado = false;
        }

        $cartera->save();

        return redirect()->route('pagosProveedores.index')
            ->with('success', 'Pago registrado correctamente.');
    }

    public function show(PagoProveedor $pagosProveedore)
    {
        return view('pagosProveedores.show', ['pago' => $pagosProveedore]);
    }

    public function destroy(PagoProveedor $pagosProveedore)
    {
        // Cuando eliminas un pago, se debería devolver el saldo a cartera
        $cartera = CarteraProveedor::where('compra_id', $pagosProveedore->compra_id)->first();

        if ($cartera) {
            $cartera->saldo_pendiente += $pagosProveedore->monto_pago;
            $cartera->estado = true;
            $cartera->save();
        }

        $pagosProveedore->delete();

        return back()->with('success', 'Pago eliminado correctamente y saldo restaurado.');
    }
}
