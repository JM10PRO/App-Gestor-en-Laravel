<x-layouts.app title="Tareas" meta-description="Tareas meta description">

    <h1>Listado de Tareas</h1>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td>Id</td>
                    <!-- <td>NIF</td> -->
                    <td>Persona de contacto</td>
                    <td>Estado de la tarea</td>
                    <td>Operario</td>
                    <td>Fecha de realización</td>
                    <!-- <td>Descripción</td> -->
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($tareas as $tarea)
                <tr>
                    <td>{{$tarea->id}}</td>
                    {{-- <!-- <td>{{$tarea->nif}}</td> --> --}}
                    <td>{{$tarea->personacontacto}}</td>
                    <td>{{$tarea->estado}}</td>
                    <td>{{$tarea->operario ?: 'No se ha indicado'}}</td>
                    <td>{{$tarea->fecharealizacion}}</td>
                    {{-- <!-- <td>{{$tarea->descripcion}}</td> --> --}}
                    <td>
                        <a title="Detalles" class="btn btn-secondary" href="{{ route('tareas.show', $tarea) }}">@lang('Details')</a>
                        <a title="Detalles" class="btn btn-primary" href="{{ route('tareas.edit', $tarea) }}">@lang('Editar')</a>
                        @auth(Auth::user()->is_admin == 'admin')
                            <a title="Detalles" class="btn btn-danger" href="{{ route('tareas.deleteconfirmation', $tarea) }}">@lang('Borrar')</a>   
                        @endauth
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $tareas->links() }}
    </div>
</x-layouts.app>