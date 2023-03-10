<nav class="navbar navbar-expand-lg bg-custom-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Nosecaen S.L.</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="d-flex justify-content-start">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav d-flex align-items-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                    </li>
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Gestionar tareas</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('tareas.index') }}">Listar tareas</a></li>
                                <li><a class="dropdown-item" href="{{ route('tareas.create') }}">Crear tarea</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Gestionar clientes</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('clientes.index') }}">Listar clientes</a></li>
                                <li><a class="dropdown-item" href="{{ route('clientes.create') }}">Dar de alta</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Gestionar empleados</button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('empleados.index') }}">Listar empleados</a></li>
                                <li><a class="dropdown-item" href="{{ route('empleados.create') }}">Nuevo empleado</a></li>
                            </ul>
                        </div>
                        <li class="nav-item">
                            <a class="btn btn-link" aria-current="page" href="{{ route('cuotas.index') }}">Cuotas</a>
                        </li>
                    @endif
                    @if(Auth::check() && Auth::user()->isOperario())
                        <a href="{{ route('operario.tareas.index') }}" class="btn btn-link">Mis tareas pendientes</a>
                    @endif
                    @guest
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">Register</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}">Login</a>
                      </li>
                    @endguest                    
                </ul>
            </div>
        </div>
       

        <div>
            @auth
                Usuario conectado: {{ Auth::user()->name }} <br>
                Rol: {{ Auth::user()->getRole() }} | Conexión: {{ session('hora'); }}  
            @endauth
        </div>
        <div>
            @auth
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    
                        <a href="/logout" class="nav-link text-danger logout" onclick="this.closest('form').submit();">Cerrar sesión</a>
                    
                </form>
            @endauth
        </div>
    </div>
</nav>
