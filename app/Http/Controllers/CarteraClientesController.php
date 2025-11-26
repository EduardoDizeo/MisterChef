<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarteraCliente;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Exception;

class CarteraClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartera_clientes = CarteraCliente::all();
        // dd($cartera_clientes); //para imprimir en pantalla
        return view('carteraClientes.index',compact('cartera_clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('carteraClientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cartera_cliente = CarteraCliente::create($request->all());
        return redirect()->route('carteraClientes.index')->with('siccessMag','El registro se guardo exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Buscar el registro por su id
    $cartera_cliente = CarteraCliente::findOrFail($id);

    // Retornar la vista con el registro
    return view('carteraClientes.show', compact('cartera_cliente'));
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
    public function destroy(CarteraCliente $carteraCliente)
    {
        try {
            $carteraCliente->delete();
            return redirect()->route('carteraClientes.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            // Capturar y manejar violaciones de restricción de clave foránea
            Log::error('Error al eliminar el país: ' . $e->getMessage());
            return redirect()->route('carteraClientes.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            // Capturar y manejar cualquier otra excepción
            Log::error('Error inesperado al eliminar el país: ' . $e->getMessage());
            return redirect()->route('carteraClientes.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }

    public function cambioestadocarteracliente(Request $request)
	{
		$cartera_cliente = CarteraCliente::find($request->id);
		$cartera_cliente->estado=$request->estado;
		$cartera_cliente->save();
	}
}
