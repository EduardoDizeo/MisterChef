@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Cartera de Clientes</h1>
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
                            Listado de Cartera de Clientes
                        </div>

                        <div class="card-body bg-white">
                            <table id="example1" class="table table-bordered text-center table-striped">
                                <thead style="background-color: #f5d76e; color: #000;">
                                    <tr>
                                        <th>ID</th>
                                        <th>ID Factura Venta</th>
                                        <th>Saldo Pendiente</th>
                                        <th>Estado</th>
                                        <th>Ver</th> {{-- Nueva columna para ver detalle --}}
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartera_clientes as $cartera_cliente)
                                    <tr>
                                        <td>{{ $cartera_cliente->id }}</td>
                                        <td>{{ $cartera_cliente->factura_id }}</td>
                                        <td>${{ number_format($cartera_cliente->saldo_pendiente, 2) }}</td>
                                        <td>
                                            <input data-type="carteracliente" data-id="{{ $cartera_cliente->id }}"
                                                   class="toggle-class" type="checkbox"
                                                   data-onstyle="success" data-offstyle="danger"
                                                   data-toggle="toggle" data-on="Activo" data-off="Inactivo"
                                                   {{ $cartera_cliente->estado ? 'checked' : '' }}
                                                   style="min-width: 100px;">
                                        </td>
                                        <td>
                                            <a href="{{ route('carteraClientes.show', $cartera_cliente->id) }}" 
                                               class="btn btn-info btn-sm" title="Ver Detalle">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form class="delete-form"
                                                  action="{{ route('carteraClientes.destroy', $cartera_cliente) }}"
                                                  method="POST">
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
                            {{-- {{ $cartera_clientes->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
