<nav class="sb-topnav navbar navbar-expand navbar-dark" aria-label="Barra de administración">
    <a class="navbar-brand ps-3" href="{{ route('admin.home') }}">▥ &nbsp;Librería Virtual</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" type="button" aria-label="Mostrar u ocultar menú" aria-controls="sidenavAccordion" aria-expanded="true"><i class="fas fa-bars" aria-hidden="true"></i></button>
    <span class="text-white-50 small d-none d-md-inline ms-2">Administración</span>
    <ul class="navbar-nav ms-auto me-3 me-lg-4">
        <li class="nav-item dropdown">
            <button class="nav-link dropdown-toggle border-0 bg-transparent" id="adminAccount" type="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $email }}</button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminAccount">
                <li><a class="dropdown-item" href="{{ route('admin.perfil') }}">Mi cuenta</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><form action="{{ route('logout.auth') }}" method="post">@csrf <button type="submit" class="dropdown-item">Cerrar sesión</button></form></li>
            </ul>
        </li>
    </ul>
</nav>
