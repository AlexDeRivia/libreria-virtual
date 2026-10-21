<nav class="navbar navbar-expand-lg site-nav sticky-top" aria-label="Navegación principal">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}" aria-label="Librería Virtual, inicio">
            <span class="brand-mark" aria-hidden="true">▥</span>
            <span class="brand-name">Librería Virtual<small>Demo interactiva</small></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#publicMenu" aria-controls="publicMenu" aria-expanded="false" aria-label="Abrir menú"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="publicMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" @if(request()->routeIs('home')) aria-current="page" @endif>Inicio</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('catalogo.*') ? 'active' : '' }}" href="{{ route('catalogo.index') }}" @if(request()->routeIs('catalogo.*')) aria-current="page" @endif>Catálogo</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('nosotros') ? 'active' : '' }}" href="{{ route('nosotros') }}" @if(request()->routeIs('nosotros')) aria-current="page" @endif>Acerca de la demo</a></li>
                @if (config('demo.public_access'))
                    <li class="nav-item"><a class="nav-link nav-action" href="{{ route('login') }}">Explorar roles</a></li>
                @else
                    <li class="nav-item"><a class="nav-link nav-quiet" href="{{ route('login') }}">Ingresar</a></li>
                    <li class="nav-item"><a class="nav-link nav-action" href="{{ route('register') }}">Crear cuenta</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>
