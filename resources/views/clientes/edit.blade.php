@extends('layouts.app')

@section('title','Editar Cliente')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Editar Cliente</h1>
    </section>
    @include('layouts.partial.msg')
    <section class="content">
        <div class="container-fluid">
            <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h3>Datos del Cliente</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nombre completo</label>
                            <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $cliente->nombre) }}">
                        </div>
                        <div class="form-group">
                            <label>Nombre del negocio</label>
                            <input type="text" class="form-control" name="nombre_negocio" value="{{ old('nombre_negocio', $cliente->nombre_negocio) }}">
                        </div>
                        <!-- Eliminé tipo_documento y documento porque no existen en tu tabla -->
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $cliente->telefono) }}">
                        </div>
                        <div class="form-group">
                            <label>Correo electrónico</label>
                            <input type="email" class="form-control" name="correo" value="{{ old('correo', $cliente->correo_electronico) }}">
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" class="form-control" name="direccion" value="{{ old('direccion', $cliente->direccion) }}">
                        </div>
                        <div class="form-group">
                            <label>Estado</label>
                            <select class="form-control" name="estado">
                                <option value="1" {{ $cliente->estado == 1 ? 'selected' : '' }}>Activo</option>
                                <option value="0" {{ $cliente->estado == 0 ? 'selected' : '' }}>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <a href="{{ route('clientes.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
