<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use App\Models\Vendedor;
use App\Models\Producto;
use App\Models\CarteraCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use Carbon\Carbon;
use Exception;

class FacturaController extends Controller
{
    // Mostrar todas las facturas con detalles y productos relacionados
    public function index()
    {

        $facturas = Factura::with(['vendedor', 'detallesFactura.producto'])->get();
        return view('facturas.index', compact('facturas'));
    }


    // Mostrar el formulario para crear una nueva factura
    public function create()
    {
        $clientes = Cliente::all();
        $vendedores = Vendedor::all();
        $productos = Producto::all();

        return view('facturas.create', compact('clientes', 'vendedores', 'productos'));
    }

    // Almacenar una nueva factura
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validación (existente)
            $validated = $request->validate([
                'cliente_id' => 'required|exists:clientes,id',
                'fecha' => 'required|date',
                'total' => 'required|numeric|min:0',
                'detalles' => 'required|array|min:1',
                'detalles.*.producto_id' => 'required|exists:productos,id',
                'detalles.*.cantidad' => 'required|numeric|min:1',
                'detalles.*.precio_unitario' => 'required|numeric|min:0',
            ]);

            // Crear factura (existente)
            $factura = Factura::create([
                'cliente_id' => $request->cliente_id,
                'fecha' => $request->fecha,
                'total' => $request->total,
                'estado' => 1,
                'registrado_por' => auth()->id(),
            ]);

            // Agregar detalles (existente)
            foreach ($validated['detalles'] as $detalle) {
                $producto = Producto::find($detalle['producto_id']);

                if ($producto->stockActual < $detalle['cantidad']) {
                    throw new \Exception("No hay suficiente stock para el producto: {$producto->nombre}");
                }

                $factura->detallesFactura()->create([
                    'producto_id' => $detalle['producto_id'],
                    'cantidad_producto' => $detalle['cantidad'],
                    'precio_unitario' => $detalle['precio_unitario'],
                    'subtotal' => $detalle['cantidad'] * $detalle['precio_unitario'],
                ]);

                $producto->stockActual -= $detalle['cantidad'];
                $producto->save();
            }

            // CREAR REGISTRO EN CARTERA CLIENTE (NUEVO)
            $cartera = CarteraCliente::create([
                'factura_id' => $factura->id,
                'saldo_pendiente' => $factura->total, // El saldo inicial es el total de la factura
                'estado' => true // Estado activo
            ]);

            DB::commit();

            return redirect()->route('facturas.index')
                ->with('success', 'Factura creada correctamente con ID: ' . $factura->id);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al crear factura: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al crear la factura: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Mostrar el formulario para editar una factura
    public function edit(Factura $factura)
    {
        $clientes = Cliente::all();
        $vendedores = Vendedor::all();

        return view('facturas.edit', compact('factura', 'clientes', 'vendedores'));
    }

    // Actualizar una factura existente
    public function update(Request $request, Factura $factura)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'nit_cliente' => 'nullable|string|max:255',
            'telefono_cliente' => 'nullable|string|max:15',
            'nombre_negocio' => 'required|string|max:255',
            'fecha_venta' => 'required|date',
            'total_factura' => 'required|numeric',
            'cliente_id' => 'required|exists:clientes,id',
            'vendedor_id' => 'required|exists:vendedores,id',
            'estado' => 'required|string|max:255',
            'registrado_por' => 'required|string|max:255',
        ]);

        $factura->update($request->all());

        return redirect()->route('facturas.index')->with('success', 'Factura actualizada con éxito');
    }

    // Eliminar una factura
    public function destroy(Factura $factura)
    {
        try {
            $factura->delete();
            return redirect()->route('facturas.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar la factura: ' . $e->getMessage());
            return redirect()->route('facturas.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar la factura: ' . $e->getMessage());
            return redirect()->route('facturas.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }

    // Cambiar el estado de la factura vía AJAX o similar
    public function cambioestadofactura(Request $request)
    {
        $factura = Factura::find($request->id);
        $factura->estado = $request->estado;
        $factura->save();
    }

    // Mostrar detalle de factura (puedes personalizar la vista después)
    public function show(Factura $factura)
    {
        return view('facturas.show', compact('factura'));
    }

    public function generatePDF($id)
    {
        $factura = Factura::with(['cliente', 'detallesFactura.producto'])->findOrFail($id);


        $pdf = Pdf::loadView('facturas.pdf', compact('factura'))->setPaper('letter');

        return $pdf->stream('factura_' . $factura->id . '.pdf');
    }
}
