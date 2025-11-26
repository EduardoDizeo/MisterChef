<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Exception;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'telefono' => 'nullable|string|max:20',
        'correo_electronico' => 'nullable|email|max:255',
        'direccion' => 'nullable|string|max:255',
        'estado' => 'required|boolean',
        'registrado_por' => 'required|integer',
    ]);

    try {
        Cliente::create([
            'nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'correo_electronico' => $request->correo_electronico,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
            'registrado_por' => $request->registrado_por,
        ]);

        return redirect()->route('clientes.index')->with('successMsg', 'El cliente fue registrado exitosamente');
    } catch (Exception $e) {
        Log::error('Error al crear cliente: ' . $e->getMessage());
        return redirect()->back()->withErrors('Ocurrió un error al guardar el cliente. Intenta nuevamente.')->withInput();
    }
}


    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();
            return redirect()->route('clientes.index')->with('successMsg', 'El cliente fue eliminado exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar cliente: ' . $e->getMessage());
            return redirect()->route('clientes.index')->withErrors('El cliente tiene información relacionada. No puede ser eliminado.');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar cliente: ' . $e->getMessage());
            return redirect()->route('clientes.index')->withErrors('Ocurrió un error inesperado al eliminar el cliente.');
        }
    }

    public function cambioestadocliente(Request $request)
    {
        $cliente = Cliente::find($request->id);
        $cliente->estado = $request->estado;
        $cliente->save();
    }
    public function show($id)
{
   $cliente = Cliente::findOrFail($id);
    return view('clientes.show', compact('cliente'));
}

public function edit($id)
{
    $cliente = Cliente::findOrFail($id);
    return view('clientes.edit', compact('cliente'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'telefono' => 'nullable|string|max:20',
        'correo' => 'nullable|email|max:255',
        'direccion' => 'nullable|string|max:255',
        'estado' => 'required|in:0,1',
    ]);

    try {
        $cliente = Cliente::findOrFail($id);
        $cliente->update([
            'nombre' => $request->nombre,
            'nombre_negocio' => $request->nombre_negocio,
            
            'telefono' => $request->telefono,
            'correo_electronico' => $request->correo,
            'direccion' => $request->direccion,
            'estado' => $request->estado,
        ]);

        return redirect()->route('clientes.index')->with('successMsg', 'El cliente fue actualizado exitosamente');
    } catch (Exception $e) {
        Log::error('Error al actualizar cliente: ' . $e->getMessage());
        return redirect()->back()->withErrors('Ocurrió un error al actualizar el cliente. Intenta nuevamente.')->withInput();
    }
}

}
