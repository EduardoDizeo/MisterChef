@extends('layouts.app')

@section('title', 'Editar Proveedor')

@section('content')
<div class="content-wrapper">
    <section class="content-header"></section>
    @include('layouts.partial.msg')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3>@yield('title')</h3>
                </div>
                <form method="POST" action="{{ route('proveedores.update', $proveedor->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nombre <strong style="color:red;">(*)</strong></label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $proveedor->nombre) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $proveedor->telefono) }}">
                        </div>
                        <div class="form-group">
                            <label>Correo Electrónico</label>
                            <input type="email" name="correo_electronico" class="form-control" value="{{ old('correo_electronico', $proveedor->correo_electronico) }}">
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $proveedor->direccion) }}">
                        </div>
                        <div class="form-group">
                            <label>Estado</label>
                            <select name="estado" class="form-control" required>
                                <option value="1" {{ $proveedor->estado ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ !$proveedor->estado ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                        <!-- Registrado por no se cambia aquí -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('proveedores.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
