<x-layouts.app title="Clientes" meta-description="Clientes meta description">

    <h1>¿Desea borrar el cliente {{ $cliente->id }}?</h1>

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
                </tr>
            </tbody>
        </table>
    </div>
</x-layouts.app>