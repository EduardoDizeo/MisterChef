@extends('layouts.app')

@section('title', 'Detalle de Proveedor')

@section('content')
<div class="content-wrapper" style="background-color: #fff; color: #000; min-height: 100vh;">
    <section class="content-header">
        <h1 style="color: #ff0000;">Detalle del Proveedor</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="card" style="border: 1px solid #ff0000;">
                <div class="card-header" style="background-color: #ff0000; color: #fff;">
                    <h3>Datos del Proveedor</h3>
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> {{ $proveedor->nombre ?? 'No especificado' }}</p>
                    <p><strong>Teléfono:</strong> {{ $proveedor->telefono ?? 'No especificado' }}</p>
                    <p><strong>Correo Electrónico:</strong> {{ $proveedor->correo_electronico ?? 'No especificado' }}</p>
                    <p><strong>Dirección:</strong> {{ $proveedor->direccion ?? 'No especificado' }}</p>
                    <p><strong>Estado:</strong> {{ $proveedor->estado == 1 ? 'Activo' : 'Inactivo' }}</p>
                    <p><strong>Registrado por:</strong> {{ $proveedor->registradoPor->name ?? 'No especificado' }}</p>
                </div>
                
            </div>
        </div>
    </section>
</div>
@endsection
