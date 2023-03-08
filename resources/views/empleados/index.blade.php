<x-layouts.app title="Empleados" meta-description="Empleados meta description">

    <h1>Listado de empleados</h1>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nombre</td>
                    <td>Nif</td>
                    <td>Email</td>
                    <td>Teléfono</td>
                    <td>Dirección</td>
                    <td>Rol</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($empleados as $empleado)
                <tr>
                    <td>{{$empleado->id}}</td>
                    <td>{{$empleado->name}}</td>
                    <td>{{$empleado->nif ?: 'No se ha indicado'}}</td>
                    <td>{{$empleado->email}}</td>
                    <td>{{$empleado->telefono ?: 'No se ha indicado'}}</td>
                    <td>{{$empleado->direccion ?: 'No se ha indicado'}}</td>
                    <td>{{$empleado->role}}</td>
                    <td>
                        <a title="Editar" class="btn btn-primary" href="{{ route('empleados.edit', $empleado) }}">@lang('Editar')</a>
                        @auth(Auth::user()->is_admin == 'admin')
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalBorrarEmpleado{{$empleado->id}}">
                                Borrar
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="modalBorrarEmpleado{{$empleado->id}}" tabindex="-1" aria-labelledby="modalBorrarEmpleado{{$empleado->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalBorrarEmpleado{{$empleado->id}}Label">Borrar empleado</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    ¿Está seguro que desea borrar este empleado?
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('empleados.destroy', $empleado) }}" method="post">
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
    <div class="d-flex justify-content-end">
        {{ $empleados->links() }}
    </div>
</x-layouts.app>