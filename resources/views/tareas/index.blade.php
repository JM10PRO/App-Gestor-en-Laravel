<x-layouts.app title="Tareas" meta-description="Tareas meta description">

    <h1>Listado de Tareas</h1>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>NIF</td>
                    <td>Persona de contacto</td>
                    <td>Estado de la tarea</td>
                    <td>Operario</td>
                    <td>Fecha de realización</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($tareas as $tarea)
                <tr>
                    <td>{{$tarea->id}}</td>
                    <td>{{$tarea->nif}}</td>
                    <td>{{$tarea->personacontacto}}</td>
                    <td>{{$tarea->estado}}</td>
                    <td>{{$tarea->operario ?: 'No se ha indicado'}}</td>
                    <td>{{$tarea->fecharealizacion}}</td>
                    <td>                        
                        <!-- Vertically centered scrollable modal -->
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <!-- Modal ver detalles -->
                            <div class="modal fade" id="modalVerDetallesTarea{{$tarea->id}}" tabindex="-1" aria-labelledby="modalVerDetallesTarea{{$tarea->id}}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles de la tarea {{ $tarea->id }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                        <table class="table table-striped
                                        table-hover
                                        align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Campos</th>
                                                    <th>Datos</th>
                                                </tr>
                                                </thead>
                                                <tbody class="table-group-divider">
                                                    <tr class="table-light">
                                                        <td scope="row">NIF</td>
                                                        <td>{{ $tarea->nif }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Persona contacto</td>
                                                        <td>{{ $tarea->personacontacto }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Teléfono</td>
                                                        <td>{{ $tarea->telefono }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Correo</td>
                                                        <td>{{ $tarea->correo }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Población</td>
                                                        <td>{{ $tarea->poblacion }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Código Postal</td>
                                                        <td>{{ $tarea->codpostal }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Provincia</td>
                                                        <td>{{ $tarea->provincia }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Dirección</td>
                                                        <td>{{ $tarea->direccion }}</td>
                                                    </tr>
                                                    <tr class="table-secondary">
                                                        <td scope="row">Estado</td>
                                                        <td>
                                                            @if($tarea->estado=="B")
                                                                Esperando a ser aprobada
                                                            @elseif($tarea->estado=="P")
                                                                Pendiente
                                                            @elseif ($tarea->estado=="R")
                                                                Realizada
                                                            @elseif ($tarea->estado=="C")
                                                                Cancelada
                                                            @else {{$tarea->estado}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Fecha de creación</td>
                                                        <td>{{ $tarea->fechacreacion }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Operario</td>
                                                        <td>{{ $tarea->operario ?: 'No se ha indicado' }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Fecha de realización</td>
                                                        <td>{{ $tarea->fecharealizacion }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Anotaciones anteriores</td>
                                                        <td>{{ $tarea->anotacionanterior }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Anotaciones posteriores</td>
                                                        <td>{{ $tarea->anotacionposterior }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Descripción</td>
                                                        <td>{{ $tarea->descripcion }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Fichero resumen</td>
                                                        <td>{{ $tarea->ficheroresumen }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Fotos del trabajo</td>
                                                        <td>{{ $tarea->fotos }}</td>
                                                    </tr>
                                                </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>                                   
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- Button Ver detalles modal -->
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalVerDetallesTarea{{$tarea->id}}">
                            Ver detalles
                        </button>
                        @auth(Auth::user()->is_admin == 'admin')
                        <a title="Editar" class="btn btn-primary" href="{{ route('tareas.edit', $tarea) }}">@lang('Editar')</a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalBorrarTarea{{$tarea->id}}">
                            Borrar
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="modalBorrarTarea{{$tarea->id}}" tabindex="-1" aria-labelledby="modalBorrarTarea{{$tarea->id}}Label" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalBorrarTarea{{$tarea->id}}Label">Borrar tarea</h1>
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