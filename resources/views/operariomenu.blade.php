<div class="container-fluid">
    <ul class="nav nav-pills nav-fill" style="--bs-nav-pills-link-active-bg: #fd610d;">
        <a href="" class="navbar-brand">Bunglebuild S.L</a>
        <li class="nav-item"><a href="<?= BASE_URL ?>/operariolistar" class="nav-link active" aria-current="page">Listar tareas</a></li>
        <li class="nav-item"><a href="<?= BASE_URL ?>/operariolistartareaspendientes" class="nav-link active logout" aria-current="page">Listar tareas pendientes</a></li>
        <li class="nav-item"><a href="<?= BASE_URL ?>operarioeditdata" class="nav-link active logout" aria-current="page">Cambiar mis datos</a></li>
    </ul>
    <div class="userconnected">
    Usuario conectado: <b><?=$_SESSION['usuario_conectado'];?></b> - Rol: <b><?=$_SESSION['rol']?></b> <br> Hora de conexión: <?= $_SESSION['hora_conex'] ?> &nbsp; <a id="cerrarsesion" href="<?= BASE_URL ?>/logout">Cerrar sesión</a>
    </div>
</div>