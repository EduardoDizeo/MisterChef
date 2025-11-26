@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Pagos Realizados</h1>
        </div>
    </section>

    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12 text-start">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-dark" title="Panel de control">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border-dark shadow-lg">
                        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                            <span style="font-size: 1.5rem; font-weight: 600;">Listado de Pagos</span>

                            <a href="{{ route('pagos.create') }}" class="btn btn-danger" title="Nuevo Pago">
                                <i class="fas fa-plus"></i> Nuevo
                            </a>
                        </div>

                        <div class="card-body bg-white">
                            <table id="example1" class="table table-bordered text-center table-striped">
                                <thead class="bg-warning text-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Factura</th>
                                        <th>Monto Pagado</th>
                                        <th>Fecha de Pago</th>
                                        <th>Ver</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pagos as $pago)
                                    <tr>
                                        <td>{{ $pago->id }}</td>
                                        <td>{{ $pago->factura_id }}</td>
                                        <td>${{ number_format($pago->monto_pago, 2) }}</td>
                                        <td>{{ $pago->fecha_pago }}</td>
                                        <td>
                                            <a href="{{ route('pagos.show', $pago->id) }}" class="btn btn-info btn-sm" title="Ver Detalle">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <form class="delete-form" action="{{ route('pagos.destroy', $pago) }}" method="POST">
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

                            {{-- Paginación si usas --}}
                            {{-- {{ $pagos->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
