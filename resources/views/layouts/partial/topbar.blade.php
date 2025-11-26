<!-- Navbar -->
<nav class="main-header navbar navbar-expand" style="background-color: #ff0000; color: white;">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: white;">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false" v-pre style="color: white;">
        @auth
      {{ Auth::user()->name }}
    @else
      <a class="nav-link" href="{{ route('login') }}" style="color: white;">Iniciar sesión</a>
    @endauth
      </a>
    </li>

    <li class="nav-item flex items-center" style="display: flex; margin: auto; padding-inline: 20px;">
      <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class='fas fa-sign-out-alt' style="font-size: 22px;"></i>
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </li>
  </ul>
</nav>
<!-- /.navbar -->