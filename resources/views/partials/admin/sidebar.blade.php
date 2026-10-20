<div id="layoutSidenav_nav">
    <nav class="sb-sidenav sb-sidenav-dark" id="sidenavAccordion" aria-label="Secciones de administración">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Resumen</div>
                <a class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}" href="{{ route('admin.home') }}" @if(request()->routeIs('admin.home')) aria-current="page" @endif><span class="sb-nav-link-icon"><i class="fas fa-house" aria-hidden="true"></i></span> Inicio</a>
                <a class="nav-link {{ request()->routeIs('admin.pedidos*') ? 'active' : '' }}" href="{{ route('admin.pedidos') }}"><span class="sb-nav-link-icon"><i class="fas fa-box" aria-hidden="true"></i></span> Pedidos</a>
                <div class="sb-sidenav-menu-heading">Catálogo</div>
                <a class="nav-link {{ request()->routeIs('admin.libros*') ? 'active' : '' }}" href="{{ route('admin.libros') }}"><span class="sb-nav-link-icon"><i class="fas fa-book" aria-hidden="true"></i></span> Libros</a>
                <a class="nav-link {{ request()->routeIs('admin.ejemplares*') ? 'active' : '' }}" href="{{ route('admin.ejemplares') }}"><span class="sb-nav-link-icon"><i class="fas fa-copy" aria-hidden="true"></i></span> Ejemplares</a>
                <a class="nav-link {{ request()->routeIs('admin.autores*') ? 'active' : '' }}" href="{{ route('admin.autores') }}"><span class="sb-nav-link-icon"><i class="fas fa-pen" aria-hidden="true"></i></span> Autores</a>
                <a class="nav-link {{ request()->routeIs('admin.idiomas*') ? 'active' : '' }}" href="{{ route('admin.idiomas') }}"><span class="sb-nav-link-icon"><i class="fas fa-language" aria-hidden="true"></i></span> Idiomas</a>
                <a class="nav-link {{ request()->routeIs('admin.nacionalidades*') ? 'active' : '' }}" href="{{ route('admin.nacionalidades') }}"><span class="sb-nav-link-icon"><i class="fas fa-globe" aria-hidden="true"></i></span> Nacionalidades</a>
                <a class="nav-link {{ request()->routeIs('admin.especialidades*') ? 'active' : '' }}" href="{{ route('admin.especialidades') }}"><span class="sb-nav-link-icon"><i class="fas fa-tags" aria-hidden="true"></i></span> Especialidades</a>
                <div class="sb-sidenav-menu-heading">Clientes y envíos</div>
                <a class="nav-link {{ request()->routeIs('admin.usuarios*') ? 'active' : '' }}" href="{{ route('admin.usuarios') }}"><span class="sb-nav-link-icon"><i class="fas fa-users" aria-hidden="true"></i></span> Usuarios</a>
                <a class="nav-link {{ request()->routeIs('admin.preferenciasEnvio*') ? 'active' : '' }}" href="{{ route('admin.preferenciasEnvio') }}"><span class="sb-nav-link-icon"><i class="fas fa-truck" aria-hidden="true"></i></span> Preferencias de envío</a>
                <a class="nav-link {{ request()->routeIs('admin.paises*') ? 'active' : '' }}" href="{{ route('admin.paises') }}"><span class="sb-nav-link-icon"><i class="fas fa-map" aria-hidden="true"></i></span> Países</a>
                <a class="nav-link {{ request()->routeIs('admin.provincias*') ? 'active' : '' }}" href="{{ route('admin.provincias') }}"><span class="sb-nav-link-icon"><i class="fas fa-location-dot" aria-hidden="true"></i></span> Provincias</a>
                <div class="sb-sidenav-menu-heading">Cuenta</div>
                <a class="nav-link {{ request()->routeIs('admin.perfil') ? 'active' : '' }}" href="{{ route('admin.perfil') }}"><span class="sb-nav-link-icon"><i class="fas fa-user" aria-hidden="true"></i></span> Mi cuenta</a>
            </div>
        </div>
        <div class="sb-sidenav-footer"><div class="small">Sesión activa</div>{{ $email }}</div>
    </nav>
</div>
