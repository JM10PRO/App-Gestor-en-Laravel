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
                        <a title="Editar" class="btn btn-primary" href="{{ route('tareas.edit', $tarea) }}">@lang('Editar')</a>
                        @auth(Auth::user()->is_admin == 'admin')
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Borrar
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Borrar tarea</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                ¿Está seguro que desea borrar esta tarea?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('tareas.destroy', $tarea) }}" method="post">
                                    @csrf 
                                    @method('DELETE')
        
                                    <button class="btn btn-danger">@lang('Borrar')</button>
                                </form>  
                                </div>
                            </div>
                            </div>
                        </div>  
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