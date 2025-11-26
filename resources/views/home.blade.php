@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Panel de Control</h1>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- Clientes --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $clientes }}</h3>
                            <p>Clientes</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('clientes.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- Proveedores --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $proveedores }}</h3>
                            <p>Proveedores</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <a href="{{ route('proveedores.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- Facturas --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $facturas }}</h3>
                            <p>Facturas</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-invoice"></i>
                        </div>
                        <a href="{{ route('facturas.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- Productos --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $productos }}</h3>
                            <p>Productos</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <a href="{{ route('productos.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- Compras --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $compras }}</h3>
                            <p>Compras</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="{{ route('compras.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- Cartera Proveedores --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-dark">
                        <div class="inner">
                            <h3>{{ $carteraProveedores }}</h3>
                            <p>Cartera Proveedores</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <a href="{{ route('carteraProveedores.index') }}" class="small-box-footer text-white">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- Cartera Clientes --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $carteraClientes }}</h3>
                            <p>Cartera Clientes</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <a href="{{ route('carteraClientes.index') }}" class="small-box-footer text-white">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                {{-- Pagos --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-pink">
                        <div class="inner">
                            <h3>{{ $pagos }}</h3>
                            <p>Pagos</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <a href="{{ route('pagos.index') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
