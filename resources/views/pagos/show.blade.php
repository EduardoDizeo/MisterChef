@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Detalle del Pago</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-12 text-start">
                    <a href="{{ route('pagos.index') }}" class="btn btn-secondary" title="Volver al listado">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-dark shadow-lg">
                        <div class="card-header text-white font-weight-bold" style="background-color: #000;">
                            Información del Pago
                        </div>
                        <div class="card-body bg-white">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $pago->id }}</td>
                                </tr>
                                <tr>
                                    <th>Factura</th>
                                    <td>{{ $pago->factura_id }}</td>
                                </tr>
                                <tr>
                                    <th>Cliente</th>
                                    <td>{{ $pago->cliente->nombre ?? 'Cliente no encontrado' }}</td>
                                </tr>
                                <tr>
                                    <th>Método de Pago</th>
                                    <td>{{ $pago->metodo_pago }}</td>
                                </tr>
                                <tr>
                                    <th>Monto Pagado</th>
                                    <td>${{ number_format($pago->monto_pago, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de Pago</th>
                                    <td>{{ $pago->fecha_pago }}</td>
                                </tr>
                                <tr>
                                    <th>Registrado por</th>
                                    <td>{{ $pago->usuario->name ?? 'Usuario desconocido' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
