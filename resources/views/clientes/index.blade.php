@extends('layouts.app')

@section('title', 'Listado de Clientes')

@section('content')
<div class="content-wrapper">

    {{-- Encabezado --}}
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Clientes</h1>
        </div>
    </section>

    {{-- Mensajes flash --}}
    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">

            {{-- Botones superiores --}}
            <div class="row mb-3">
                <div class="col-6 text-start">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary" title="Volver al Panel">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('clientes.create') }}" class="btn btn-danger" title="Nuevo Cliente">
                        <i class="fas fa-user-plus"></i> Nuevo Cliente
                    </a>
                </div>
            </div>

            {{-- Tabla --}}
            <div class="row">
                <div class="col-12">
                    <div class="card border-dark shadow-lg">
                        <div class="card-header text-center"
                             style="background-color: #000; color: #fff; font-size: 1.5rem; font-weight: 600;">
                            Listado de Clientes
                        </div>

                        <div class="card-body bg-white">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered text-center table-striped">
                                    <thead style="background-color: #f5d76e; color: #000;">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Documento</th>
                                            <th>Teléfono</th>
                                            <th>Dirección</th>
                                            <th>Correo</th>
                                            <th>Estado</th>
                                            <th style="min-width: 150px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clientes as $cliente)
                                        <tr>
                                            <td>{{ $cliente->id }}</td>
                                            <td>{{ $cliente->nombre }}</td>
                                            <td>{{ $cliente->nit }}</td>
                                            <td>{{ $cliente->telefono }}</td>
                                            <td>{{ $cliente->direccion }}</td>
                                            <td>{{ $cliente->correo_electronico }}</td>
                                            <td>
                                                <input data-type="cliente" data-id="{{ $cliente->id }}"
                                                       class="toggle-class" type="checkbox"
                                                       data-onstyle="success" data-offstyle="danger"
                                                       data-toggle="toggle" data-on="Activo" data-off="Inactivo"
                                                       {{ $cliente->estado ? 'checked' : '' }}
                                                       style="min-width: 100px;">
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    {{-- Ver --}}
                                                    <a href="{{ route('clientes.show', $cliente) }}"
                                                       class="btn btn-info btn-sm me-1" title="Ver">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    {{-- Editar --}}
                                                    <a href="{{ route('clientes.edit', $cliente) }}"
                                                       class="btn btn-warning btn-sm me-1" title="Editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    {{-- Eliminar --}}
                                                    <form class="delete-form" action="{{ route('clientes.destroy', $cliente) }}" method="POST">
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

                            {{-- Paginación (si usas paginación en el controlador) --}}
                            {{-- {{ $clientes->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection