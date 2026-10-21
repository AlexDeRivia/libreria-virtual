@if (config('demo.public_access'))
<section class="demo-access {{ !empty($compact) ? 'demo-access-compact' : '' }}" aria-labelledby="demo-access-title">
    <div class="demo-access-heading">
        <div>
            <p class="eyebrow mb-2">Recorrido interactivo</p>
            <h2 id="demo-access-title">Explora los cuatro roles</h2>
            <p>Cambia de rol con un clic. Los datos son compartidos y se restablecen cada día; usa solo información ficticia.</p>
        </div>
    </div>
    <div class="demo-role-grid">
        @foreach (config('demo.roles') as $role => $profile)
            <div class="demo-role-card">
                <div class="demo-role-number" aria-hidden="true">{{ sprintf('%02d', $loop->iteration) }}</div>
                <h3>{{ $profile['label'] }}</h3>
                @if (empty($compact))<p>{{ $profile['description'] }}</p>@endif
                <form method="post" action="{{ route('demo.enter', ['role' => $role]) }}">
                    @csrf
                    <button type="submit" class="btn {{ $role === 'cliente' ? 'btn-primary' : 'btn-outline-dark' }}">Entrar como {{ strtolower($profile['label']) }}</button>
                </form>
            </div>
        @endforeach
    </div>
</section>
@endif
