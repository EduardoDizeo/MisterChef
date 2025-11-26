<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\CarteraProveedor;
use App\Models\DetalleCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::with(['proveedor', 'detallesCompra.producto'])->get();
        return view('compras.index', compact('compras'));
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all(); // Productos iniciales (se filtran por AJAX)

        return view('compras.create', compact('proveedores', 'productos'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'proveedor_id' => 'required|exists:proveedores,id',
                'fecha_compra' => 'required|date',
                'total' => 'required|numeric|min:0',
                'detalles' => 'required|array|min:1',
                'detalles.*.producto_id' => 'required|exists:productos,id',
                'detalles.*.cantidad' => 'required|numeric|min:1',
                'detalles.*.precio_unitario' => 'required|numeric|min:0',
            ]);

            // Crear compra
            $compra = Compra::create([
                'proveedor_id' => $request->proveedor_id,
                'fecha_compra' => $request->fecha_compra,
                'total_compra' => $request->total,
                'estado' => 1,
                'registrado_por' => auth()->id(),
            ]);

            // Agregar detalles
            foreach ($validated['detalles'] as $detalle) {
                $compra->detallesCompra()->create([
                    'producto_id' => $detalle['producto_id'],
                    'cantidad' => $detalle['cantidad'],
                    'precio_unitario' => $detalle['precio_unitario'],
                    'subtotal' => $detalle['cantidad'] * $detalle['precio_unitario'],
                ]);

                // Actualizar stock del producto
                $producto = Producto::find($detalle['producto_id']);
                $producto->stockActual += $detalle['cantidad'];
                $producto->save();
            }

            // CREAR REGISTRO EN CARTERA PROVEEDOR (NUEVO)
            CarteraProveedor::create([
                'compra_id' => $compra->id,
                'saldo_pendiente' => $compra->total_compra, // El saldo inicial es el total de la compra
                'estado' => true // Estado activo
            ]);

            DB::commit();

            return redirect()->route('compras.index')
                ->with('success', 'Compra registrada correctamente con ID: ' . $compra->id);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al registrar compra: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Error al registrar la compra: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Compra $compra)
    {
        try {
            $compra->delete();
            return redirect()->route('compras.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar la compra: ' . $e->getMessage());
            return redirect()->route('compras.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar la compra: ' . $e->getMessage());
            return redirect()->route('compras.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }

    public function cambioestadocompra(Request $request)
    {
        $compra = Compra::find($request->id);
        $compra->estado = $request->estado;
        $compra->save();
    }

    public function generatePDF($id)
    {
        $compra = Compra::with(['proveedor', 'detallesCompra.producto'])->findOrFail($id);
        $pdf = Pdf::loadView('compras.pdf', compact('compra'))->setPaper('letter');
        return $pdf->stream('compra_' . $compra->id . '.pdf');
    }

    // Método para obtener productos por proveedor (AJAX)
    public function productosPorProveedor($proveedorId)
    {
        $productos = Producto::where('proveedor_id', $proveedorId)->get();
        return response()->json($productos);
    }
}