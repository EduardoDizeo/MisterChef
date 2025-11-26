@extends('layouts.app')

@section('title', 'Registrar Pago')
@include('layouts.partial.msg')

@section('content')
<div class="content-wrapper">
    <section class="content-header text-center">
        <div class="container-fluid">
            <h1 class="text-dark font-weight-bold">Registrar Pago</h1>
        </div>
    </section>

    @include('layouts.partial.msg')

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-lg border-dark">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">Nuevo Pago</h3>
                </div>
                <form method="POST" action="{{ route('pagos.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Número de Factura <strong class="text-danger">*</strong></label>
                            <select name="factura_id" class="form-control select2">
                                <option value="">Seleccione una factura</option>
                                @foreach($facturas as $factura)
                                    <option value="{{ $factura->id }}" {{ old('factura_id') == $factura->id ? 'selected' : '' }}>
                                        Factura #{{ $factura->id }} - Cliente: {{ $factura->cliente->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Monto del Pago <strong class="text-danger">*</strong></label>
                            <input type="number" step="0.01" class="form-control" name="monto_pago" placeholder="Ingrese el valor" value="{{ old('monto_pago') }}">
                        </div>

                        <div class="form-group">
                            <label>Método de Pago <strong class="text-danger">*</strong></label>
                            <select name="metodo_pago" class="form-control">
                                <option value="">Seleccione método</option>
                                <option value="Efectivo" {{ old('metodo_pago') == 'Efectivo' ? 'selected' : '' }}>Efectivo</option>
                                <option value="Transferencia" {{ old('metodo_pago') == 'Transferencia' ? 'selected' : '' }}>Transferencia</option>
                            </select>
                        </div>

                        <input type="hidden" name="fecha_pago" value="{{ now() }}">
                        <input type="hidden" name="registrado_por" value="{{ Auth::id() }}">
                    </div>

                    <div class="card-footer d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary mr-2">Registrar</button>
                        <a href="{{ route('pagos.index') }}" class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
