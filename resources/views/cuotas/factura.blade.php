<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura de la cuota</title>
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        div.contenedor {
            margin-top: 5%;
        }
        table{
            margin: 0 auto;
            border: 1px solid #000;
            border-radius: 10px;
        }
        th {
            font-size: 1.5rem;
            background-color: #b8b2b2;
            border: 1px solid #000;
            border-radius: 3px;
            padding: 5px;
        }
        td{
            text-align: left;
            font-size: larger;
            padding: 10px 70px 10px 7px;
            background-color: #c0e299;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <table>
            <thead>
                <tr>
                    <th>Campos</th>
                    <th>Datos</th>
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
                    <td>{{ $cuota['importe'] }} €</td>
                </tr>
                <tr>
                    <td><b>Concepto</b></td>
                    <td>{{ $cuota['concepto'] }}</td>
                </tr>
                <tr>
                    <td><b>Pagado</b></td>
                    <td @if($cuota['pagado'] == 0) style="color:#f00;"> No pagada @else >Pagada @endif</td>
                </tr>
                <tr>
                    <td><b>Fecha de pago</b></td>
                    <td>@if($fecha_pago == null) Aún no pagada @else {{ $fecha_pago }} @endif</td>
                </tr>
                <tr>
                    <td><b>Notas</b></td>
                    <td>{{ $cuota['notas'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
    
   
    
