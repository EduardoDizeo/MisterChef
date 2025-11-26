@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Productos</h1>
        </div>
    </section>

    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">

            <div class="row mb-3">
                <div class="col-6 text-start">
                    {{-- Botón salir al panel de control --}}
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary" title="Salir">
                        <i class="fas fa-arrow-left"></i> Salir
                    </a>
                </div>
                <div class="col-6 text-end">
                    {{-- Botón nuevo producto --}}
                    <a href="{{ route('productos.create') }}" class="btn btn-danger" title="Nuevo">
                        <i class="fas fa-plus"></i> Nuevo Producto
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card border-dark shadow-lg">
                        <div class="card-header text-center"
                             style="background-color: #000; color: #fff; font-size: 1.5rem; font-weight: 600;">
                            Listado de Productos
                        </div>

                        <div class="card-body bg-white">
                            <table id="example1" class="table table-bordered text-center table-striped">
                                <thead style="background-color: #f5d76e; color: #000;">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Precio de Venta</th>
                                        <th>Stock Actual</th>
                                        <th>Stock Mínimo</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productos as $producto)
                                    <tr>
                                        <td>{{ $producto->id }}</td>
                                        <td>{{ $producto->nombre }}</td>
                                        <td>${{ number_format($producto->precio_venta, 2) }}</td>
                                        <td>{{ $producto->stockActual }}</td>
                                        <td>{{ $producto->stockMinimo }}</td>
                                        <td>
                                            <input data-type="producto" data-id="{{ $producto->id }}"
                                                   class="toggle-class" type="checkbox"
                                                   data-onstyle="success" data-offstyle="danger"
                                                   data-toggle="toggle" data-on="Activo" data-off="Inactivo"
                                                   {{ $producto->estado ? 'checked' : '' }}
                                                   style="min-width: 100px;">
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">
                                                {{-- Botón Mostrar --}}
                                                <a href="{{ route('productos.show', $producto) }}"
                                                   class="btn btn-info btn-sm" title="Mostrar">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                {{-- Botón Editar --}}
                                                <a href="{{ route('productos.edit', $producto) }}"
                                                   class="btn btn-warning btn-sm" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                {{-- Formulario Eliminar --}}
                                                <form class="delete-form" action="{{ route('productos.destroy', $producto) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este producto?');">
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

                            {{-- Paginación opcional --}}
                            {{-- {{ $productos->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
