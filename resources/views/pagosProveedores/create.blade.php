@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Registrar Pago a Proveedor</h1>
        </div>
    </section>

    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-lg border-dark">

                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">Nuevo Pago</h3>
                </div>

                <form method="POST" action="{{ route('pagosProveedores.store') }}">
                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <label>Compra (Factura) <strong class="text-danger">*</strong></label>
                            <select name="compra_id" class="form-control select2">
                                <option value="">Seleccione una compra</option>

                                @foreach($facturas as $compra)
                                    <option value="{{ $compra->id }}">
                                        Compra #{{ $compra->id }} 
                                        - Proveedor: {{ $compra->proveedor->nombre }}
                                        - Saldo: ${{ number_format($compra->carteraProveedor->saldo_pendiente, 2) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Monto del Pago <strong class="text-danger">*</strong></label>
                            <input type="number" name="monto_pago" class="form-control" step="0.01">
                        </div>

                        <div class="form-group">
                            <label>Método de Pago</label>
                            <select name="metodo_pago" class="form-control">
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                            </select>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Registrar</button>
                        <a href="{{ route('pagosProveedores.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>

                </form>

            </div>
        </div>
    </section>
</div>
@endsection
