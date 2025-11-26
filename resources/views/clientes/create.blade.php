@extends('layouts.app')

@section('title','Crear Cliente')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
        </div>
    </section>
    @include('layouts.partial.msg')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <h3>@yield('title')</h3>
                        </div>
                        <form method="POST" action="{{ route('clientes.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <!-- Nombre -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Nombre completo <strong style="color:red;">(*)</strong></label>
                                            <input type="text" class="form-control" name="nombre" placeholder="Ej. Juan Pérez" value="{{ old('nombre') }}" required>
                                        </div>
                                    </div>

                                    <!-- Teléfono -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Teléfono</label>
                                            <input type="text" class="form-control" name="telefono" placeholder="Ej. 3101234567" value="{{ old('telefono') }}">
                                        </div>
                                    </div>

                                    <!-- Correo electrónico -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Correo electrónico</label>
                                            <input type="email" class="form-control" name="correo_electronico" placeholder="Ej. cliente@mail.com" value="{{ old('correo_electronico') }}">
                                        </div>
                                    </div>

                                    <!-- Dirección -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Dirección</label>
                                            <input type="text" class="form-control" name="direccion" placeholder="Ej. Calle 10 #5-50" value="{{ old('direccion') }}">
                                        </div>
                                    </div>

                                    <!-- NIT -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>NIT</label>
                                            <input type="text" class="form-control" name="nit" placeholder="Ej. 900123456" value="{{ old('nit') }}">
                                        </div>
                                    </div>

                                    <!-- Estado (oculto, activo por defecto) -->
                                    <input type="hidden" name="estado" value="1">

                                    <!-- Registrado por (usuario autenticado) -->
                                    <input type="hidden" name="registrado_por" value="{{ Auth::user()->id }}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-2 col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
                                    </div>
                                    <div class="col-lg-2 col-xs-4">
                                        <a href="{{ route('clientes.index') }}" class="btn btn-danger btn-block btn-flat">Atrás</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
