@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Detalle Cartera Cliente #{{ $cartera_cliente->id }}</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-12 text-start">
                    <a href="{{ route('carteraClientes.index') }}" class="btn btn-secondary" title="Volver">
                        <i class="fas fa-arrow-left"></i> Volver a la lista
                    </a>
                </div>
            </div>

            <div class="card border-dark shadow-lg">
                <div class="card-header bg-dark text-white text-center">
                    Información Detallada
                </div>
                <div class="card-body">
                    <p><strong>ID:</strong> {{ $cartera_cliente->id }}</p>
                    <p><strong>ID Factura Venta:</strong> {{ $cartera_cliente->factura_id }}</p>
                    <p><strong>Saldo Pendiente:</strong> ${{ number_format($cartera_cliente->saldo_pendiente, 2) }}</p>
                    <p><strong>Estado:</strong> {{ $cartera_cliente->estado ? 'Activo' : 'Inactivo' }}</p>
                    {{-- Agrega más campos si los tienes --}}
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
