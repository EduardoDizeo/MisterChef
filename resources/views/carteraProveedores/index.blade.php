@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Cartera de Proveedores</h1>
        </div>
    </section>

    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-12 text-start">
                    {{-- Botón salir al panel de control --}}
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary" title="Salir">
                        <i class="fas fa-arrow-left"></i> Salir
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border-dark shadow-lg">
                        <div class="card-header text-center"
                             style="background-color: #000; color: #fff; font-size: 1.5rem; font-weight: 600;">
                            Listado de Cartera de Proveedores
                        </div>

                        <div class="card-body bg-white">
                            <table id="example1" class="table table-bordered text-center table-striped">
                                <thead style="background-color: #f5d76e; color: #000;">
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Factura Compra</th>
                                        <th>Saldo Pendiente</th>
                                        <th>Estado</th>
                                        <th>Ver</th> {{-- Nueva columna para ver detalle --}}
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartera_proveedores as $cartera_proveedor)
                                    <tr>
                                        <td>{{ $cartera_proveedor->id }}</td>
                                        <td>{{ $cartera_proveedor->compra_id }}</td>
                                        <td>${{ number_format($cartera_proveedor->saldo_pendiente, 2) }}</td>
                                        <td>
                                            <input data-type="carteraproveedor" data-id="{{ $cartera_proveedor->id }}"
                                                   class="toggle-class" type="checkbox"
                                                   data-onstyle="success" data-offstyle="danger"
                                                   data-toggle="toggle" data-on="Activo" data-off="Inactivo"
                                                   {{ $cartera_proveedor->estado ? 'checked' : '' }}
                                                   style="min-width: 100px;">
                                        </td>
                                        <td>
                                            <a href="{{ route('carteraProveedores.show', $cartera_proveedor) }}" 
                                               class="btn btn-info btn-sm" title="Ver detalle">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form class="delete-form" action="{{ route('carteraProveedores.destroy', $cartera_proveedor) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Paginación opcional --}}
                            {{-- {{ $cartera_proveedores->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
