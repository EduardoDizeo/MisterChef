<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Factura;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Auth;

class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pagos = Pago::all();
        return view('pagos.index', compact('pagos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $facturas = Factura::with('cliente')->get();
        return view('pagos.create', compact('facturas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'factura_id' => 'required|exists:facturas,id',
            'monto_pago' => 'required|numeric|min:0',
            'metodo_pago' => 'required|string',
        ]);

        // Obtener la factura para obtener cliente_id
        $factura = Factura::findOrFail($request->factura_id);

        $pago = Pago::create([
            'factura_id' => $request->factura_id,
            'cliente_id' => $factura->cliente_id,  // se asigna cliente desde factura
            'monto_pago' => $request->monto_pago,
            'fecha_pago' => now(),
            'metodo_pago' => $request->metodo_pago,
            'registrado_por' => Auth::id(),
        ]);

        $cartera = \App\Models\CarteraCliente::where('factura_id', $request->factura_id)->first();

        if ($cartera) {
            // Restar el pago del saldo pendiente
            $cartera->saldo_pendiente -= $request->monto_pago;

            // Evitar saldos negativos
            if ($cartera->saldo_pendiente < 0) {
                $cartera->saldo_pendiente = 0;
            }

            // Si el saldo queda en 0, marcar como pagado
            if ($cartera->saldo_pendiente == 0) {
                $cartera->estado = 'Pagado';
            }

            $cartera->save();
        }

        return redirect()->route('pagos.index')->with('success', '¡Pago registrado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pago = Pago::with(['usuario', 'cliente'])->findOrFail($id);
        return view('pagos.show', compact('pago'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pago $pago)
    {
        try {
            $pago->delete();
            return redirect()->route('pagos.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar el pago: ' . $e->getMessage());
            return redirect()->route('pagos.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar el pago: ' . $e->getMessage());
            return redirect()->route('pagos.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }
}
