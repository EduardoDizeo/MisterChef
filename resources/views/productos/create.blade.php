@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="container bg-white p-4 rounded shadow border" style="max-width: 500px;">
        
        {{-- Título centrado --}}
        <h2 class="text-center text-danger mb-4">Registrar Producto</h2>

        <form action="{{ route('productos.store') }}" method="POST">
            @csrf

            {{-- Nombre y Proveedor en fila --}}
            <div class="row mb-3">
                <div class="col-6">
                    <label class="form-label fw-bold">Nombre</label>
                    <input type="text" name="nombre" class="form-control form-control-sm" value="{{ old('nombre') }}">
                    @error('nombre') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                <div class="col-6">
                    <label class="form-label fw-bold">Proveedor</label>
                    <div class="input-group input-group-sm">
                        <select class="form-control select2" name="proveedor_id" id="select-proveedor">
                            <option value="">Seleccione un proveedor</option>
                            @foreach($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}" {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                                    {{ $proveedor->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('proveedor_id') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
            </div>

           

            {{-- Precio compra y venta --}}
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label fw-bold">Precio Compra</label>
                    <input type="number" step="0.01" name="precio_compra" class="form-control form-control-sm" value="{{ old('precio_compra') }}">
                    @error('precio_compra') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                <div class="col">
                    <label class="form-label fw-bold">Precio Venta</label>
                    <input type="number" step="0.01" name="precio_venta" class="form-control form-control-sm" value="{{ old('precio_venta') }}">
                    @error('precio_venta') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Stock y Estado --}}
            <div class="row mb-3">
                <div class="col-6">
                    <label class="form-label fw-bold">Stock Actual</label>
                    <input type="number" name="stockActual" class="form-control form-control-sm" value="{{ old('stockActual') }}">
                    @error('stockActual') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
                <div class="col-6">
                    <label class="form-label fw-bold">Estado</label>
                    <select name="estado" class="form-select form-select-sm">
                        <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- Botones --}}
            <div class="text-center mt-4">
                <a href="{{ route('productos.index') }}" class="btn btn-outline-pink btn-sm me-2" style="background-color: #f8d7da; border-color: #f5c2c7; color: #842029;">
                    <i class="bi bi-arrow-left-circle"></i> Atrás
                </a>
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-save"></i> Guardar Producto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
