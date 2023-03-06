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
                        <!-- Vertically centered scrollable modal -->
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <!-- Modal ver detalles -->
                            <div class="modal fade" id="modalVerDetallesCliente{{$cliente->id}}" tabindex="-1" aria-labelledby="modalVerDetallesCliente{{$cliente->id}}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detalles del cliente {{$cliente->id}}</h1>
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
                                                        <td scope="row">CIF</td>
                                                        <td>{{ $cliente->cif }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Nombre</td>
                                                        <td>{{ $cliente->nombre }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Teléfono</td>
                                                        <td>{{ $cliente->telefono }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Correo</td>
                                                        <td>{{ $cliente->correo }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Cuenta corriente</td>
                                                        <td>{{ $cliente->cuenta_corriente }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">País</td>
                                                        <td>{{ $cliente->pais }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Moneda</td>
                                                        <td>{{ $cliente->moneda }}</td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <td scope="row">Cuota mensual</td>
                                                        <td>{{ $cliente->cuota_mensual }}</td>
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
                        <!-- Button Ver detalles clientes modal -->
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalVerDetallesCliente{{$cliente->id}}">
                            Ver detalles
                        </button>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalBorrarTarea">
                            Borrar
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="modalBorrarTarea" tabindex="-1" aria-labelledby="modalBorrarCliente{{$cliente->id}}Label" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalBorrarCliente{{$cliente->id}}Label">Borrar cliente {{ $cliente->id }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                ¿Está seguro que desea borrar a este cliente?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('clientes.destroy', $cliente) }}" method="post">
                                    @csrf 
                                    @method('DELETE')
        
                                    <button class="btn btn-danger">@lang('Borrar')</button>
                                </form>  
                                </div>
                            </div>
                            </div>
                        </div>  
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