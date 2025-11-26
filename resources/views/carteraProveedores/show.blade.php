@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Detalle de Cartera del Proveedor</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-12 text-start">
                    <a href="{{ route('carteraProveedores.index') }}" class="btn btn-secondary" title="Volver">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-dark shadow-lg">
                        <div class="card-header bg-dark text-white">
                            <strong>Información de la Cartera</strong>
                        </div>
                        <div class="card-body bg-light">
                            <p><strong>ID:</strong> {{ $carteraProveedor->id }}</p>
                            <p><strong>ID Factura Compra:</strong> {{ $carteraProveedor->compra_id }}</p>
                            <p><strong>Proveedor:</strong> {{ $carteraProveedor->compra->proveedor->nombre ?? 'N/A' }}</p>
                            <p><strong>Saldo Pendiente:</strong> ${{ number_format($carteraProveedor->saldo_pendiente, 2) }}</p>
                            <p><strong>Estado:</strong> 
                                <span class="badge {{ $carteraProveedor->estado ? 'bg-success' : 'bg-danger' }}">
                                    {{ $carteraProveedor->estado ? 'Activo' : 'Inactivo' }}
                                </span>
                            </p>
                            <p><strong>Fecha de Registro:</strong> {{ $carteraProveedor->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
