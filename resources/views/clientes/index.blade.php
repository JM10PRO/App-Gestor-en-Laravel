<x-layouts.app title="Clientes" meta-description="Clientes meta description">

    <h1>Listado de Clientes</h1>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>CIF</td>
                    <td>Nombre</td>
                    <td>Teléfono</td>
                    <td>Correo</td>
                    <td>Cuota mensual</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($clientes as $cliente)
                <tr>
                    <td>{{$cliente->id}}</td>
                    <td>{{$cliente->cif}}</td>
                    <td>{{$cliente->nombre}}</td>
                    <td>{{$cliente->telefono}}</td>
                    <td>{{$cliente->correo}}</td>
                    <td>{{$cliente->cuota_mensual}}</td>
                    <td>
                        <a title="Detalles" class="btn btn-secondary" href="{{ route('clientes.show', $cliente) }}">@lang('Details')</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $clientes->links() }}
    </div>
</x-layouts.app>