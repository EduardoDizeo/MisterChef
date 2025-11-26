@extends('layouts.app')

@section('title', 'Listado de Proveedores')

@section('content')
<div class="content-wrapper">
    {{-- Encabezado --}}
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Proveedores</h1>
        </div>
    </section>

    {{-- Mensajes flash --}}
    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">

            {{-- Botones superior: volver y crear --}}
            <div class="row mb-3">
                <div class="col-6 text-start">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary" title="Volver al Panel">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('proveedores.create') }}" class="btn btn-danger" title="Nuevo Proveedor">
                        <i class="fas fa-plus"></i> Nuevo Proveedor
                    </a>
                </div>
            </div>

            {{-- Tabla --}}
            <div class="row">
                <div class="col-12">
                    <div class="card border-dark shadow-lg">
                        <div class="card-header text-center"
                             style="background-color: #000; color: #fff; font-size: 1.5rem; font-weight: 600;">
                            Listado de Proveedores
                        </div>

                        <div class="card-body bg-white">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered text-center table-striped">
                                    <thead style="background-color: #f0b3d3; color: #5b0e2d;">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th>Correo</th>
                                            <th>Dirección</th>
                                            <th>Estado</th>
                                            <th style="min-width: 140px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($proveedores as $proveedor)
                                        <tr style="background-color: #fff0f6;">
                                            <td>{{ $proveedor->id }}</td>
                                            <td>{{ $proveedor->nombre }}</td>
                                            <td>{{ $proveedor->telefono }}</td>
                                            <td>{{ $proveedor->correo_electronico }}</td>
                                            <td>{{ $proveedor->direccion }}</td>
                                            <td>
                                                <input data-type="proveedor" data-id="{{ $proveedor->id }}"
                                                       class="toggle-class" type="checkbox"
                                                       data-onstyle="success" data-offstyle="danger"
                                                       data-toggle="toggle" data-on="Activo" data-off="Inactivo"
                                                       {{ $proveedor->estado ? 'checked' : '' }}
                                                       style="min-width: 100px;">
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    {{-- Ver detalles --}}
                                                    <a href="{{ route('proveedores.show', $proveedor) }}" 
                                                       class="btn btn-info btn-sm me-1" title="Ver detalles">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    {{-- Editar --}}
                                                    <a href="{{ route('proveedores.edit', $proveedor) }}"
                                                       class="btn btn-warning btn-sm me-1" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    {{-- Eliminar --}}
                                                    <form class="delete-form" action="{{ route('proveedores.destroy', $proveedor) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este proveedor?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Paginación opcional --}}
                            {{-- {{ $proveedores->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
