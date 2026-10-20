<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h2 class="h4">Librería Virtual</h2>
                <p>Explora libros, crea pedidos y sigue entregas dentro de una demostración interactiva. Las compras y los envíos son simulados.</p>
            </div>
            <div class="col-md-5">
                <h2 class="h5">Explorar</h2>
                <ul class="list-unstyled d-grid gap-2 mb-0">
                    <li><a href="{{ route('catalogo.index') }}">Ver el catálogo</a></li>
                    <li><a href="{{ route('nosotros') }}">Cómo funciona la demo</a></li>
                    <li><a href="{{ route('login') }}">Ingresar</a></li>
                    <li><a href="{{ route('register') }}">Crear cuenta de demostración</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">@include('partials.shared.credits')</div>
    </div>
</footer>
