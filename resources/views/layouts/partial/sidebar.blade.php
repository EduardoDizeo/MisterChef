<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4" style="background-color: #e20000; color: white;">
  <!-- Brand Logo -->
  <a href="#" class="brand-link text-center" style="background-color: #ffffff; color: black;">
    <img src="img/logo.png" alt="Distribuciones Jayu Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-bold">Mister Chef</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline mt-3">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search"
          style="background-color: #ffd1d1; color: black; border: none; font-weight: bold;">
        <div class="input-group-append">
          <button class="btn btn-sidebar" style="background-color: white; color: black;">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="{{route('productos.index')}}" class="nav-link" style="color: white;">
            <i class="nav-icon fas fa-box"></i>
            <p>Producto</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('clientes.index')}}" class="nav-link" style="color: white;">
            <i class="nav-icon fas fa-user-tie" style="color: white;"></i>
            <p>Clientes</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('proveedores.index') }}" class="nav-link" style="color: white;">
            <i class="nav-icon fas fa-truck" style="color: white;"></i>
            <p>Proveedores</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('facturas.index') }}" class="nav-link" style="color: white;">
            <i class="nav-icon fas fa-file-invoice" style="color: white;"></i>
            <p>Facturas</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('compras.index') }}" class="nav-link" style="color: white;">
            <i class="nav-icon fas fa-shopping-cart" style="color: white;"></i>
            <p>Compras</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('carteraProveedores.index') }}" class="nav-link" style="color: white;">
            <i class="nav-icon fas fa-wallet" style="color: white;"></i>
            <p>Cartera de Proveedores</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('carteraClientes.index') }}" class="nav-link" style="color: white;">
            <i class="nav-icon fas fa-wallet" style="color: white;"></i>
            <p>Cartera de Clientes</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('pagos.index') }}" class="nav-link" style="color: white;">
            <i class="nav-icon fas fa-money-bill" style="color: white;"></i>


            <p>Pagos Factura</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('pagosProveedores.index') }}" class="nav-link" style="color: white;">
            <i class="nav-icon fas fa-money-bill" style="color: white;"></i>


            <p>Pagos compra</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>