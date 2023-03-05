<x-layouts.app title="Home" meta-description="Home meta description">

    <h1>Home</h1>

    @auth    
        <div class="container">
            Usuario conectado: {{ Auth::user()->name }}
        </div>
    @endauth
    @guest
        <div class="container">
            <a href="{{ route('crearincidencia') }}" class="btn btn-primary">Registrar incidencia</a>
        </div>
    @endguest

</x-layouts.app>