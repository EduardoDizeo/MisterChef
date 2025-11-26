@extends('layouts.app')

@section('title', 'Crear Proveedor')

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
                <form method="POST" action="{{ route('proveedores.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nombre <strong style="color:red;">(*)</strong></label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                        </div>
                        <div class="form-group">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
                        </div>
                        <div class="form-group">
                            <label>Correo Electrónico</label>
                            <input type="email" name="correo_electronico" class="form-control" value="{{ old('correo_electronico') }}">
                        </div>
                        <div class="form-group">
                            <label>Dirección</label>
                            <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}">
                        </div>

                        <!-- Estado oculto, activo por defecto -->
                        <input type="hidden" name="estado" value="1">

                        <!-- Registrado por usuario autenticado -->
                        <input type="hidden" name="registrado_por" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <a href="{{ route('proveedores.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
