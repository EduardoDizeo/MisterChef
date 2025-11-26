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
                    <a href="{{ route('pagosProveedores.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-dark shadow-lg">

                        <div class="card-header bg-dark text-white">
                            Información del Pago
                        </div>

                        <div class="card-body bg-white">
                            <table class="table table-bordered">

                                <tr>
                                    <th>ID</th>
                                    <td>{{ $pago->id }}</td>
                                </tr>

                                <tr>
                                    <th>Compra</th>
                                    <td>#{{ $pago->compra_id }}</td>
                                </tr>

                                <tr>
                                    <th>Proveedor</th>
                                    <td>{{ $pago->proveedor->nombre }}</td>
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
                                    <th>Fecha</th>
                                    <td>{{ $pago->fecha_pago }}</td>
                                </tr>

                                <tr>
                                    <th>Registrado Por</th>
                                    <td>{{ $pago->usuario->name }}</td>
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
