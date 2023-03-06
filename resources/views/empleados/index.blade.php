<x-layouts.app title="empleados" meta-description="empleados meta description">

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
                    {{-- <!-- <td>{{$empleado->nif}}</td> --> --}}
                    <td>{{$empleado->name}}</td>
                    <td>{{$empleado->nif ?: 'No se ha indicado'}}</td>
                    <td>{{$empleado->email}}</td>
                    <td>{{$empleado->telefono ?: 'No se ha indicado'}}</td>
                    <td>{{$empleado->direccion ?: 'No se ha indicado'}}</td>
                    <td>{{$empleado->role}}</td>
                    {{-- <!-- <td>{{$empleado->descripcion}}</td> --> --}}
                    <td>
                        <a title="Detalles" class="btn btn-secondary" href="{{ route('empleados.show', $empleado) }}">@lang('Details')</a>
                        <a title="Detalles" class="btn btn-primary" href="{{ route('empleados.edit', $empleado) }}">@lang('Editar')</a>
                        @auth(Auth::user()->is_admin == 'admin')
                            <a title="Detalles" class="btn btn-danger" href="{{ route('empleados.destroy', $empleado) }}">@lang('Borrar')</a>   
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