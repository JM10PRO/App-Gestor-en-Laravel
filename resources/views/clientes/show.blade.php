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
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Borrar cliente</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    ¿Está seguro que desea borrar este cliente?
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <a title="Borrar" class="btn btn-danger" href="{{ route('clientes.destroy', $cliente) }}">@lang('Borrar')</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                        @endauth
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layouts.app>