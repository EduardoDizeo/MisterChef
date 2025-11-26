@extends('layouts.app')

@section('title', 'Crear Factura')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid"></div>
        </section>

        @include('layouts.partial.msg')

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-dark shadow-lg">
                            <div class="card-header bg-dark text-white">
                                <h3>@yield('title')</h3>
                            </div>
                            <form method="POST" action="{{ route('facturas.store') }}" id="form-factura">
                                @csrf
                                <div class="card-body" style="background-color: #f5f5f5;">
                                    <!-- Datos Principales -->
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Cliente <strong
                                                        style="color:red;">(*)</strong></label>
                                                <select class="form-control select2" name="cliente_id" id="select-cliente"
                                                    required>
                                                    <option value="">Seleccione un cliente</option>
                                                    @foreach($clientes as $cliente)
                                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Fecha <strong
                                                        style="color:red;">(*)</strong></label>
                                                <input type="date" class="form-control" name="fecha" id="fecha"
                                                    value="{{ date('Y-m-d') }}" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tabla de Detalles -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <h4>Detalles de Factura</h4>
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="tabla-detalles">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Producto</th>
                                                            <th>Cantidad</th>
                                                            <th>Precio Unitario</th>
                                                            <th>Subtotal</th>
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="detalles-body">
                                                        <!-- Detalles se agregarán aquí dinámicamente -->
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="3" class="text-right">TOTAL:</th>
                                                            <th id="total-general">0.00</th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Formulario para agregar detalles -->
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Producto <strong style="color:red;">(*)</strong></label>
                                                <select class="form-control select2" id="select-producto">
                                                    <option value="">Seleccione producto</option>
                                                    @foreach($productos as $producto)
                                                        <option value="{{ $producto->id }}"
                                                            data-precio="{{ $producto->precio_venta }}">{{ $producto->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Cantidad <strong style="color:red;">(*)</strong></label>
                                                <input type="number" class="form-control" id="cantidad" min="1" value="1">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Precio Unitario</label>
                                                <input type="number" class="form-control" id="precio-unitario" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Subtotal</label>
                                                <input type="number" class="form-control" id="subtotal" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-end">
                                            <button type="button" class="btn btn-primary btn-block"
                                                id="btn-agregar-detalle">
                                                <i class="fas fa-plus"></i> Agregar
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-dark">
                                    <div class="row">
                                        <div class="col-lg-2 col-xs-4">
                                            <button type="submit" class="btn btn-success btn-block btn-flat">
                                                <i class="fas fa-save"></i> Guardar Factura
                                            </button>
                                        </div>
                                        <div class="col-lg-2 col-xs-4">
                                            <a href="{{ route('facturas.index') }}"
                                                class="btn btn-danger btn-block btn-flat">
                                                <i class="fas fa-times"></i> Cancelar
                                            </a>
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

@push('scripts')
    <script src="{{ asset('backend/dist/js/factura.js') }}"></script>
@endpush

@section('scripts')
    <!-- Primero los mensajes flash -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}",
            });
        </script>
    @endif
@endsection

