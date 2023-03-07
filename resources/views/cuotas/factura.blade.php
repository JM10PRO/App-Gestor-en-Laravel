<x-layouts.app title="Cuotas" meta-description="Cuotas meta description">
    
    <div class="container m-5 mx-auto">
        <div class="card text-start">
            <div class="card-header h3 bg-primary-subtle text-center">Factura de la cuota</div>
            <div class="card-body">
                <div class="container mx-auto">
                    <div class="table-responsive rounded border border-1">
                    <table class="table table-info">
                        <thead>
                            <tr>
                                <th scope="col" class="h5">Campos</th>
                                <th scope="col" class="h5">Datos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>Pagador</b></td>
                                <td>{{ $pagador }}</td>
                            </tr>
                            <tr>
                                <td><b>Beneficiario</b></td>
                                <td>Nosecaen S.L.</td>
                            </tr>
                            <tr>
                                <td><b>Fecha de emisión</b></td>
                                <td>{{ $fecha_emision }}</td>
                            </tr>
                            <tr>
                                <td><b>Importe</b></td>
                                <td>{{ $cuota->importe }} €</td>
                            </tr>
                            <tr>
                                <td><b>Concepto</b></td>
                                <td>{{ $cuota->concepto }}</td>
                            </tr>
                            <tr>
                                <td><b>Pagado</b></td>
                                <td @if($cuota->pagado == 0) class="text-danger-emphasis"> No pagada @else >Pagada @endif</td>
                            </tr>
                            <tr>
                                <td><b>Fecha de pago</b></td>
                                <td>@if($fecha_pago == null) Aún no pagada @else {{ $fecha_pago }} @endif</td>
                            </tr>
                            <tr>
                                <td><b>Notas</b></td>
                                <td>{{ $cuota->notas }}</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-layouts.app>