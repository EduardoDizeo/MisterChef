<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Auth; // Importar Auth para obtener el usuario autenticado
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Exception;

class ProductoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::where('estado', '=', '1')->orderBy('nombre')->get();
        $proveedores = Proveedor::where('estado', '=', '1')->orderBy('nombre')->get();
        return view('productos.create', compact('productos', 'proveedores'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'precio_compra' => 'required|numeric',
        'precio_venta' => 'required|numeric',
        'stockActual' => 'required|integer',
        'proveedor_id' => 'required|exists:proveedores,id',
        'estado' => 'required|boolean',
    ]);

    $validated['gramaje'] = 0;
    $validated['stockMinimo'] = 0;
    $validated['registrado_por'] = Auth::user()->id;

    Producto::create($validated);

    return redirect()->route('productos.index')->with('successMsg', 'El registro se guardó exitosamente');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        try {
            $producto->delete();
            return redirect()->route('productos.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            // Capturar y manejar violaciones de restricción de clave foránea
            Log::error('Error al eliminar el país: ' . $e->getMessage());
            return redirect()->route('productos.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            // Capturar y manejar cualquier otra excepción
            Log::error('Error inesperado al eliminar el país: ' . $e->getMessage());
            return redirect()->route('productos.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }

    public function cambioestadoproducto(Request $request)
    {
        $producto = Producto::find($request->id);
        $producto->estado = $request->estado;
        $producto->save();
    }
    // Mostrar un producto específico
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    // Mostrar formulario para editar producto
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        // Si tienes proveedores, pásalos también para el select
        $proveedores = \App\Models\Proveedor::all();
        return view('productos.edit', compact('producto', 'proveedores'));
    }

    // Actualizar el producto
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio_compra' => 'required|numeric',
            'precio_venta' => 'required|numeric',
            'stockActual' => 'required|integer',
            'stockMinimo' => 'required|integer',
            'proveedor_id' => 'required|exists:proveedores,id',
            'estado' => 'required|boolean',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    public function getByProveedor($id)
{
    $productos = Producto::where('proveedor_id', $id)->get(['id', 'nombre', 'precio_compra']);
    return response()->json($productos);
}

}
