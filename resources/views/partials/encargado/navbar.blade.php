<nav class="navbar navbar-expand-lg site-nav sticky-top" aria-label="Navegación de envíos">
    <div class="container">
        <a class="navbar-brand" href="{{ route('encargado.home') }}" aria-label="Librería Virtual, pedidos de envío"><span class="brand-mark" aria-hidden="true">▥</span><span class="brand-name">Librería Virtual<small>Gestión de envíos</small></span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#staffMenu" aria-controls="staffMenu" aria-expanded="false" aria-label="Abrir menú"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="staffMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('encargado.home') ? 'active' : '' }}" href="{{ route('encargado.home') }}" @if(request()->routeIs('encargado.home')) aria-current="page" @endif>Pedidos</a></li>
                <li class="nav-item"><form action="{{ route('logout.auth') }}" method="post">@csrf <button class="nav-link nav-quiet w-100 text-start" type="submit">Salir</button></form></li>
            </ul>
        </div>
    </div>
</nav>
