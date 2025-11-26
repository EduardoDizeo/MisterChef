<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarteraProveedor;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Exception;

class CarteraProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartera_proveedores = CarteraProveedor::all();
        // dd($cartera_proveedores); //para imprimir en pantalla
        return view('carteraProveedores.index', compact('cartera_proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    $carteraProveedor = CarteraProveedor::with('compra.proveedor')->findOrFail($id);

    return view('carteraProveedores.show', compact('carteraProveedor'));
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
    public function destroy(CarteraProveedor $carteraProveedor)
    {
        try {
            $carteraProveedor->delete();
            return redirect()->route('carteraProveedores.index')->with('successMsg', 'El registro se eliminó exitosamente');
        } catch (QueryException $e) {
            Log::error('Error al eliminar el proveedor: ' . $e->getMessage());
            return redirect()->route('carteraProveedores.index')->withErrors('El registro que desea eliminar tiene información relacionada. Comuníquese con el Administrador');
        } catch (Exception $e) {
            Log::error('Error inesperado al eliminar el proveedor: ' . $e->getMessage());
            return redirect()->route('carteraProveedores.index')->withErrors('Ocurrió un error inesperado al eliminar el registro. Comuníquese con el Administrador');
        }
    }

    public function cambioestadocarteraproveedor(Request $request)
    {
        $cartera_proveedor = CarteraProveedor::find($request->id);
        $cartera_proveedor->estado = $request->estado;
        $cartera_proveedor->save();
    }
}
