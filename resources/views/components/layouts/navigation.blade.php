<nav class="navbar navbar-expand-lg bg-custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Nosecaen S.L.</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tareas.index') }}">Lista de Tareas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tareas.create') }}">Crear tarea</a>
                </li>
                @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">Register</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">Login</a>
                  </li>
                @endguest
                @auth
                  <form action="{{ route('logout') }}" method="POST">
                      @csrf
                      <li class="nav-item">
                        <a href="#" class="nav-link" onclick="this.closest('form').submit()">Logout</a>
                      </li>
                  </form>
                @endauth
            </ul>
        </div>
    </div>
</nav>
