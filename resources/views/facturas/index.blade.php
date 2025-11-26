@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Facturas</h1>
        </div>
    </section>

    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-6 text-start">
                    {{-- Botón salir al panel de control --}}
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary" title="Salir">
                        <i class="fas fa-arrow-left"></i> Salir
                    </a>
                </div>
                <div class="col-6 text-end">
                    {{-- Botón nueva factura --}}
                    <a href="{{ route('facturas.create') }}" class="btn btn-danger" title="Nueva Factura">
                        <i class="fas fa-plus"></i> Nueva Factura
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border-dark shadow-lg">
                        <div class="card-header text-center"
                             style="background-color: #000; color: #fff; font-size: 1.5rem; font-weight: 600;">
                            Listado de Facturas
                        </div>

                        <div class="card-body bg-white">
                            <table id="example1" class="table table-bordered text-center table-striped">
                                <thead style="background-color: #f5d76e; color: #000;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Fecha Venta</th>
                                        <th>Total Factura</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($facturas as $factura)
                                    <tr>
                                        <td>{{ $factura->id }}</td>
                                        <td>{{ $factura->cliente->nombre }}</td>
                                        <td>{{ $factura->fecha }}</td>
                                        <td>${{ number_format($factura->total, 2) }}</td>
                                        <td>
                                            <input data-type="factura" data-id="{{ $factura->id }}"
                                                   class="toggle-class" type="checkbox"
                                                   data-onstyle="success" data-offstyle="danger"
                                                   data-toggle="toggle" data-on="Pagado" data-off="Pendiente"
                                                   {{ $factura->estado ? 'checked' : '' }}
                                                   style="min-width: 100px;">
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                
                                                <a href="{{ route('facturas.show', $factura) }}"
                                                   class="btn btn-info btn-sm" title="Ver Detalles">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                {{-- Botón PDF --}}
                                                <a href="{{ route('facturas.pdf', $factura->id) }}" class="btn btn-success btn-sm" title="Imprimir Formato" target="_blank"><i class="fas fa-print"></i></a>
                                                <form class="delete-form" action="{{ route('facturas.destroy', $factura) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- Paginación opcional --}}
                            {{-- {{ $facturas->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
