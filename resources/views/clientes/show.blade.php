@extends('layouts.app')

@section('title', 'Detalle de Cliente')

@section('content')
<div class="content-wrapper" style="background-color: #fff; color: #000; min-height: 100vh;">
    <section class="content-header">
        <h1 style="color: #ff0000;">Detalle del Cliente</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card" style="border: 1px solid #ff0000;">
                <div class="card-header" style="background-color: #ff0000; color: #fff;">
                    <h3>Datos del Cliente</h3>
                </div>
                <div class="card-body" style="color: #000;">
                    <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
                    <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                    <p><strong>Correo electrónico:</strong> {{ $cliente->correo_electronico }}</p>
                    <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
                    <p><strong>Estado:</strong> {{ $cliente->estado == 1 ? 'Activo' : 'Inactivo' }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between" style="background-color: #fff;">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-danger">Atrás</a>
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-outline-danger">Editar</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
