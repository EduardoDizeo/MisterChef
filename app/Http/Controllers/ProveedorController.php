<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ProveedorController extends Controller
{
    use ValidatesRequests;

    // Mostrar la lista de proveedores
    public function index()
    {
        $proveedores = Proveedor::all();  
        return view('proveedores.index', compact('proveedores'));
    }

    // Mostrar un proveedor específico
    public function show(Proveedor $proveedor)
    {
      return view('proveedores.show', compact('proveedor'));
    }

    // Mostrar formulario para crear
    public function create()
    {
        return view('proveedores.create');
    }

    // Guardar nuevo proveedor
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'correo_electronico' => 'nullable|email',
            'direccion' => 'nullable|string|max:255',
            'estado' => 'required|string',
            'registrado_por' => 'required|string',
        ]);

        Proveedor::create($validated);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor registrado correctamente.');
    }

    // Mostrar formulario para editar
    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    // Actualizar proveedor
    public function update(Request $request, Proveedor $proveedor)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'correo_electronico' => 'nullable|email',
            'direccion' => 'nullable|string|max:255',
            'estado' => 'required|string',
            'registrado_por' => 'required|string',
        ]);

        $proveedor->update($validated);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
    }

    // Eliminar proveedor
    public function destroy(Proveedor $proveedor)
    {
        try {
            $proveedor->delete();
            return redirect()->route('proveedores.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar el proveedor: ' . $e->getMessage());
            return redirect()->route('proveedores.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar el proveedor: ' . $e->getMessage());
            return redirect()->route('proveedores.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }

    // Cambiar estado 
    public function cambioestadoproveedor(Request $request)
    {
        $proveedor = Proveedor::find($request->id);
        $proveedor->estado = $request->estado;
        $proveedor->save();
    }
}
