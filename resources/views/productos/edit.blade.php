@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Editar Producto</h1>
        </div>
    </section>

    @include('layouts.partial.msg')

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
                            Editar Producto #{{ $producto->id }}
                        </div>
                        <div class="card-body bg-white">
                            <form action="{{ route('productos.update', $producto) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control" 
                                           value="{{ old('nombre', $producto->nombre) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="precio_compra" class="form-label">Precio de Compra</label>
                                    <input type="number" step="0.01" name="precio_compra" id="precio_compra" 
                                           class="form-control" value="{{ old('precio_compra', $producto->precio_compra) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="precio_venta" class="form-label">Precio de Venta</label>
                                    <input type="number" step="0.01" name="precio_venta" id="precio_venta" 
                                           class="form-control" value="{{ old('precio_venta', $producto->precio_venta) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="stockActual" class="form-label">Stock Actual</label>
                                    <input type="number" name="stockActual" id="stockActual" class="form-control" 
                                           value="{{ old('stockActual', $producto->stockActual) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="stockMinimo" class="form-label">Stock Mínimo</label>
                                    <input type="number" name="stockMinimo" id="stockMinimo" class="form-control" 
                                           value="{{ old('stockMinimo', $producto->stockMinimo) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="proveedor_id" class="form-label">Proveedor</label>
                                    <select name="proveedor_id" id="proveedor_id" class="form-select" required>
                                        <option value="" disabled>Seleccione un proveedor</option>
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}" 
                                                {{ old('proveedor_id', $producto->proveedor_id) == $proveedor->id ? 'selected' : '' }}>
                                                {{ $proveedor->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="estado" class="form-label">Estado</label>
                                    <select name="estado" id="estado" class="form-select" required>
                                        <option value="1" {{ old('estado', $producto->estado) == 1 ? 'selected' : '' }}>Activo</option>
                                        <option value="0" {{ old('estado', $producto->estado) == 0 ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save"></i> Guardar Cambios
                                    </button>
                                    <a href="{{ route('productos.index') }}" class="btn btn-danger">
                                        <i class="fas fa-times"></i> Cancelar
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
