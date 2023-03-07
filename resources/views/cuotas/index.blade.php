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