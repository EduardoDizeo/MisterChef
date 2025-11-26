@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Pagos a Proveedores</h1>
        </div>
    </section>

    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12 text-start">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-dark">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>

            <div class="card border-dark shadow-lg">
                <div class="card-header d-flex justify-content-between bg-dark text-white">
                    <span style="font-size: 1.5rem; font-weight: 600;">Listado de Pagos</span>

                    <a href="{{ route('pagosProveedores.create') }}" class="btn btn-danger">
                        <i class="fas fa-plus"></i> Nuevo
                    </a>
                </div>

                <div class="card-body bg-white">
                    <table id="example1" class="table table-bordered table-striped text-center">
                        <thead class="bg-warning">
                            <tr>
                                <th>ID</th>
                                <th>Compra</th>
                                <th>Proveedor</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Ver</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pagos as $pago)
                                <tr>
                                    <td>{{ $pago->id }}</td>
                                    <td>#{{ $pago->compra_id }}</td>
                                    <td>{{ $pago->proveedor->nombre }}</td>
                                    <td>${{ number_format($pago->monto_pago, 2) }}</td>
                                    <td>{{ $pago->fecha_pago }}</td>

                                    <td>
                                        <a href="{{ route('pagosProveedores.show', $pago->id) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>

                                    <td>
                                        <form action="{{ route('pagosProveedores.destroy', $pago) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection
