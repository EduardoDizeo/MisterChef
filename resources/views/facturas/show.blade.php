@extends('layouts.app')

@section('title', 'Detalle de Factura')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h3 class="mb-3">Factura N.º {{ $factura->id }}</h3>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <!-- Información de Cliente -->
            <div class="card border-dark shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <strong>Datos del Cliente</strong>
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $factura->cliente->nombre }}</p>
                    <p><strong>Dirección:</strong> {{ $factura->cliente->direccion }}</p>
                    <p><strong>Teléfono:</strong> {{ $factura->cliente->telefono }}</p>
                    <p><strong>NIT:</strong> {{ $factura->cliente->nit }}</p>
                    <p><strong>Correo:</strong> {{ $factura->cliente->correo_electronico }}</p>
                    <p><strong>Fecha de Factura:</strong> {{ \Carbon\Carbon::parse($factura->fecha)->format('d/m/Y') }}</p>
                </div>
            </div>

            <!-- Detalles de la Factura -->
            <div class="card border-dark shadow-sm">
                <div class="card-header bg-dark text-white">
                    <strong>Detalles de la Factura</strong>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach($factura->detallesFactura as $i => $detalle)
                                    @php
                                        $subtotal = $detalle->cantidad_producto * $detalle->precio_unitario;
                                        $total += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>{{ $i + 1 }}</td>
                                        <td>{{ $detalle->producto->nombre }}</td>
                                        <td>{{ $detalle->cantidad_producto }}</td>
                                        <td>$ {{ number_format($detalle->precio_unitario, 2) }}</td>
                                        <td>$ {{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <th colspan="4" class="text-right">Total:</th>
                                    <th>$ {{ number_format($total, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-4">
                <a href="{{ route('facturas.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
                <a href="{{ route('facturas.pdf', $factura->id) }}" class="btn btn-primary" target="_blank">
                    <i class="fas fa-file-pdf"></i> Ver PDF
                </a>
            </div>

        </div>
    </section>
</div>
@endsection
