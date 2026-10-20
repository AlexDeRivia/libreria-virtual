@php
    $usuario = auth('usuarios')->user();
    $pedidos = \App\Models\LineaPedido::join('pedidos', 'linea_pedidos.pedido_id', '=', 'pedidos.id')
        ->where('pedidos.usuario_id', $usuario->id)
        ->where('pedidos.estado_pedido_id', 1)
        ->count();
@endphp
<nav class="navbar navbar-expand-lg site-nav sticky-top" aria-label="Navegación del cliente">
    <div class="container">
        <a class="navbar-brand" href="{{ route('cliente.home') }}" aria-label="Librería Virtual, catálogo"><span class="brand-mark" aria-hidden="true">▥</span><span class="brand-name">Librería Virtual<small>Mi biblioteca</small></span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#clientMenu" aria-controls="clientMenu" aria-expanded="false" aria-label="Abrir menú"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="clientMenu">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('cliente.home', 'cliente.ejemplar') ? 'active' : '' }}" href="{{ route('cliente.home') }}">Catálogo</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('cliente.compras*', 'cliente.factura*') ? 'active' : '' }}" href="{{ route('cliente.compras') }}">Mis compras</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('cliente.perfil*') ? 'active' : '' }}" href="{{ route('cliente.perfil') }}">Mi perfil</a></li>
                <li class="nav-item"><a class="nav-link nav-action {{ request()->routeIs('cliente.pedido') ? 'active' : '' }}" href="{{ route('cliente.pedido') }}">Mi pedido <span class="badge bg-dark ms-1" aria-label="{{ $pedidos }} ejemplares">{{ $pedidos }}</span></a></li>
                <li class="nav-item"><form action="{{ route('logout.auth') }}" method="post">@csrf <button class="nav-link nav-quiet w-100 text-start" type="submit">Salir</button></form></li>
            </ul>
        </div>
    </div>
</nav>
