<x-layouts.app title="Tarea {{ $tarea->id }}" meta-description="Tareas meta description">

    <h1>Detalles de la tarea {{ $tarea->id }}</h1>
 
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>NIF</td>
                    <td>Persona de contacto</td>
                    <td>Teléfono</td>
                    <td>Correo</td>
                    <td>Población</td>
                    <td>Código postal</td>
                    <td>Provincia</td>
                    <td>Dirección</td>
                    <td>Estado</td>
                    <td>Fecha de creación</td>
                    <td>Operario</td>
                    <td>Fecha de realización</td>
                    <td>Anotación anterior</td>
                    <td>Anotación posterior</td>
                    <td>Descripción</td>
                    <td>Fichero resumen</td>
                    <td>Fotos</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <td>{{$tarea->id}}</td>
                    <td>{{$tarea->nif}}</td>
                    <td>{{$tarea->personacontacto}}</td>
                    <td>{{$tarea->telefono}}</td>
                    <td>{{$tarea->correo}}</td>
                    <td>{{$tarea->poblacion}}</td>
                    <td>{{$tarea->codpostal}}</td>
                    <td>{{$tarea->provincia}}</td>
                    <td>{{$tarea->direccion}}</td>
                    <td>{{$tarea->estado}}</td>
                    <td>{{$tarea->fechacreacion}}</td>
                    <td>{{$tarea->operario}}</td>
                    <td>{{$tarea->fecharealizacion}}</td>
                    <td>{{$tarea->anotacionanterior}}</td>
                    <td>{{$tarea->anotacionposterior}}</td>
                    <td>{{$tarea->descripcion}}</td>
                    <td><a href="../assets/uploads/{{$tarea->ficheroresumen}}" target="_blank">{{$tarea->ficheroresumen}}</a></td>
                    <td><a href="../assets/uploads/{{$tarea->fotos}}" target="_blank">{{$tarea->fotos}}</a></td>
                    <td>
                    <td>
                        Acciones
                    </td>
                </tr>
            </tbody>
        </table>
        <div>
        <a title="Volver" class="btn btn-secondary" href="{{ url()->previous() }}">Volver al listado</a>
        </div>
    </div>

</x-layouts.app>