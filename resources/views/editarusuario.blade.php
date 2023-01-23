@extends('_template')

@section('cuerpo')

<h1>{{$operacion}}</h1>
<div style="float:left; background-color: #5cc3f0;">
    <form method="post">
        <fieldset>
            <legend>Datos del usuario:</legend>
            <p>
                <label for="usuario">Nombre de usuario:</label>
                <input type="text" name="usuario" value="{{$usuario['usuario']}}"> <?= $errores->ErrorFormateado('usuario'); ?>
            </p>
            <p>
                <label for="password">Contraseña:</label>
                <input type="text" name="password" value="{{$usuario['password']}}"> <?= $errores->ErrorFormateado('password'); ?>
            </p>
            <p>
                <label for="rol">Rol asignado:</label>
                <input type="text" name="rol" value="{{$usuario['rol']}}"> <?= $errores->ErrorFormateado('rol'); ?>
            </p>
        </fieldset>
        <button type="submit">Enviar</button> <br><br>
    </form>
    <a class="btn btn-secondary" href="<?= BASE_URL ?>/listarusuarios?pagina={{$pagina}}">Volver al listado</a>
    <br><br>
</div>
@endsection