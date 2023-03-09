<x-layouts.app title="Cuotas" meta-description="Cuotas meta description">

    <h1>Listado de Cuotas</h1>
    
    <div class="card text-start">
        <div class="card-header">
            <a href="{{ route('cuotas.mensual') }}" class="btn btn-success">Remesa mensual</a>
            <a href="{{ route('cuotas.excepcional') }}" class="btn btn-secondary">Cuota excepcional</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Concepto</th>
                            <th scope="col">Fecha emisión</th>
                            <th scope="col">Importe</th>
                            <th scope="col">Pagado</th>
                            <th scope="col">Fecha de pago</th>
                            <th scope="col">Notas</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cuotas as $cuota)    
                            <tr>
                                <td>{{ $cuota->concepto }}</td>
                                <td>{{ $cuota->fecha_emision }}</td>
                                <td>{{ $cuota->importe }}</td>
                                <td>@if($cuota->pagado == 0) No pagada @else Pagada @endif</td>
                                <td>@if($cuota->fecha_pago == null) Aún no está pagada @else {{ $cuota->fecha_pago }} @endif</td>
                                <td>{{ $cuota->notas }}</td>
                                <td>
                                    @foreach ($clientes as $cliente)
                                        @if($cliente->id == $cuota->cliente_id)
                                            {{ $cliente->nombre }}
                                        @endif
                                    @endforeach    
                                </td>
                                <td>
                                    @foreach ($clientes as $cliente)
                                        @if($cliente->id == $cuota->cliente_id)
                                            <!-- Modal centrado ver datos cliente -->
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                <!-- Modal ver detalles -->
                                                <div class="modal fade" id="modalVerDetallesCliente{{$cliente->id}}" tabindex="-1" aria-labelledby="modalVerDetallesCliente{{$cliente->id}}Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Datos del cliente {{$cliente->id}}</h1>
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
                                            <!-- Botónn Datos de cliente cliente con modal -->
                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalVerDetallesCliente{{$cliente->id}}">
                                                Datos de cliente
                                            </button>
                                        @endif
                                    @endforeach
                                    <a href="{{ route('cuotas.generarFactura', $cuota) }}" class="btn btn-warning">Factura</a>
                                    <a href="{{ route('paypal-payment', $cuota) }}" class="btn btn-info">Pagar</a>
                                    <a href="{{ route('cuotas.edit', $cuota) }}" class="btn btn-primary">Editar</a>
                                    <!-- Botón borrar confirmación con modal -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalBorrarCuota{{$cuota->id}}">
                                        Borrar
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalBorrarCuota{{$cuota->id}}" tabindex="-1" aria-labelledby="modalBorrarCuota{{$cuota->id}}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalBorrarCuota{{$cuota->id}}Label">Borrar cuota</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            ¿Está seguro que desea borrar esta cuota?
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('cuotas.destroy', $cuota) }}" method="post">
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
        </div>
        <div class="d-flex justify-content-center">
            {{ $cuotas->links() }}
        </div>
    </div>
</x-layouts.app>