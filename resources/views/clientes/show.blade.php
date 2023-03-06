<x-layouts.app title="Clientes" meta-description="Clientes meta description">

    <h1>Cliente {{ $cliente->id }}</h1>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>CIF</td>
                    <td>Nombre</td>
                    <td>Teléfono</td>
                    <td>Correo</td>
                    <td>Cuenta corriente</td>
                    <td>País</td>
                    <td>Moneda</td>
                    <td>Cuota mensual</td>
                    <td>Opciones</td>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <tr>
                    <td>{{$cliente->id}}</td>
                    <td>{{$cliente->cif}}</td>
                    <td>{{$cliente->nombre}}</td>
                    <td>{{$cliente->telefono}}</td>
                    <td>{{$cliente->correo}}</td>
                    <td>{{$cliente->cuenta_corriente}}</td>
                    <td>{{$pais}}</td>
                    <td>{{$moneda}}</td>
                    <td>{{$cliente->cuota_mensual}}</td>
                    <td>
                        <a title="Detalles" class="btn btn-primary" href="{{ route('clientes.edit', $cliente) }}">@lang('Editar')</a>
                        @auth(Auth::user()->is_admin == 'admin')
                            <a title="Detalles" class="btn btn-danger" href="{{ route('clientes.destroy', $cliente) }}">@lang('Borrar')</a>   
                        @endauth
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layouts.app>