@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Detalles del Producto</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12 text-start">
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary" title="Volver">
                        <i class="fas fa-arrow-left"></i> Volver a Productos
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-dark shadow-lg">
                        <div class="card-header text-center bg-dark text-white" style="font-weight: 600;">
                            Producto #{{ $producto->id }} - {{ $producto->nombre }}
                        </div>
                        <div class="card-body bg-white">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Nombre</th>
                                        <td>{{ $producto->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <th>Precio de Compra</th>
                                        <td>${{ number_format($producto->precio_compra, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Precio de Venta</th>
                                        <td>${{ number_format($producto->precio_venta, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Stock Actual</th>
                                        <td>{{ $producto->stockActual }}</td>
                                    </tr>
                                    <tr>
                                        <th>Stock Mínimo</th>
                                        <td>{{ $producto->stockMinimo }}</td>
                                    </tr>
                                    <tr>
                                        <th>Proveedor</th>
                                        <td>{{ $producto->proveedor->nombre ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Estado</th>
                                        <td>
                                            @if($producto->estado)
                                                <span class="badge bg-success">Activo</span>
                                            @else
                                                <span class="badge bg-danger">Inactivo</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Registrado por</th>
                                        <td>{{ $producto->registrado_por }}</td>
                                    </tr>
                                    <tr>
                                        <th>Creado</th>
                                        <td>{{ $producto->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Actualizado</th>
                                        <td>{{ $producto->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="text-center mt-3">
                                <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Editar Producto
                                </a>
                                <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-list"></i> Volver al listado
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
