<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\Cuota;
use AmrShawky\Currency;
use App\Models\Cliente;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Mail\MessageReceived;
use Illuminate\Support\Facades\Mail;

class CuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuotas = Cuota::orderByDesc('fecha_emision')->paginate(5);
        $clientes = Cliente::get()->all();
        foreach ($clientes as $cliente) {
            $id_pais = $cliente->pais_id;
            $pais = Pais::select('nombre')->where('id', $id_pais)->first()->nombre;
            $moneda = Pais::select('nombre_moneda')->where('id', $id_pais)->first()->nombre_moneda;
            
            if($moneda == null){
                $moneda = '-';
            }

            $cliente->pais = $pais;
            $cliente->moneda = $moneda;
        }
        return view('cuotas.index', [
            'cuotas' => $cuotas,
            'clientes' => $clientes
        ]);
    }

    /**
     * Crear factura PDF
     *
     * @return void
     */
    public function generarFacturaPDF(Cuota $cuota){
        // $cuota_cliente_id = $cuota->cliente_id;
        $cliente = Cliente::select()->where('id', $cuota->cliente_id)->first();

        $nombre_cliente = $cliente->nombre;

        $moneda_cliente = $cliente->moneda;

        $importe_cuota_factura = Currency::convert()
        ->from('EUR')->to($moneda_cliente)->get();

        $importe_cuota_factura = round($importe_cuota_factura, 2);
        $cuota->importe = $importe_cuota_factura;
    
        $fecha_e = explode('-', $cuota->fecha_emision);
        $fecha_emision = implode("/", [$fecha_e[2],$fecha_e[1],$fecha_e[0]]);

        if($cuota->fecha_pago != null){
            $fecha_p = explode('-', $cuota->fecha_pago);
            $fecha_pago = implode("/", [$fecha_p[2],$fecha_p[1],$fecha_p[0]]); 
        }else {
            $fecha_pago = $cuota->fecha_pago;
        }
        $datos = ['cuota' => $cuota, 'pagador' => $nombre_cliente, 'fecha_emision' => $fecha_emision, 'fecha_pago' => $fecha_pago, 'moneda' => $moneda_cliente];
        // view()->share(['cuota' => $cuota, 'pagador' => $nombre_cliente, 'fecha_emision' => $fecha_emision, 'fecha_pago' => $fecha_pago]);
        
        $pdf = \PDF::loadView('cuotas.factura', $datos);
        $nombre_factura = date('Ymd').$cuota->id;
        // return $nombre_factura;
        return $pdf->setPaper('a4')->stream($nombre_factura.'.pdf');

        // return view('cuotas.factura', ['cuota' => $cuota, 'pagador' => $nombre_cliente, 'fecha_emision' => $fecha_emision, 'fecha_pago' => $fecha_pago]);
    }

    /**
     * Formulario Cuota mensual.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearCuotaMensual()
    {        
        return view('cuotas.mensual', ['cuota' => new Cuota()]);
    }
    
    /**
     * Guardar Cuota mensual.
     *
     * @return \Illuminate\Http\Response
     */
    public function guardarCuotaMensual(Cuota $cuota)
    {
        $datos = request()->validate([
            'concepto' => 'required',
            'fecha_emision' => 'required',
            'importe' => 'required|numeric',
            'notas' => 'required',
        ]);

        $clientes = Cliente::get()->all();

        foreach($clientes as $cliente){
            $datos['cliente_id'] = $cliente->id;
            $cuota->create($datos);
        }

        session()->flash('status', 'Se ha enviado la cuota mensual correctamente');

        return to_route('cuotas.index');
    }
    
    /**
     * Cuota excepcional.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearCuotaExcepcional()
    {
        $clientes = Cliente::get()->all();
        
        return view('cuotas.excepcional', ['cuota' => new Cuota(), 'clientes' => $clientes]);
    }
    
    /**
     * Cuota excepcional.
     *
     * @return \Illuminate\Http\Response
     */
    public function guardarCuotaExcepcional(Cuota $cuota)
    {
        $datos = request()->validate([
            'concepto' => 'required',
            'fecha_emision' => 'required',
            'fecha_pago' => 'required|date|after_or_equal:fecha_emision',
            'importe' => 'required|numeric',
            'cliente_id' => 'required',
            'notas' => 'required',
        ]);

        $cuota->create($datos);

        $datos['pagado'] = 0;

        
        $nombre_factura = date('Ymd');
        
        $correo_cliente = Cliente::select('correo')->where('id', $datos['cliente_id'])->first()->correo;
        
        // Dirreción del destinatario
        $datos['email'] = $correo_cliente;
        $datos['nombre_factura'] = $nombre_factura;
        
        $this->generarFacturaPDFEmail($datos);
        // $this->enviarEmail($datos, $pdf);

        session()->flash('status', 'La cuota se ha añadido correctamente');

        return to_route('cuotas.index');
    }

    /**
     * Crear factura PDF Email
     *
     * @return void
     */
    public function generarFacturaPDFEmail($cuota){
        // $cuota_cliente_id = $cuota->cliente_id;
        $nombre_cliente = Cliente::select('nombre')->where('id', $cuota['cliente_id'])->first();
        $fecha_e = explode('-', $cuota['fecha_emision']);
        $fecha_emision = implode("/", [$fecha_e[2],$fecha_e[1],$fecha_e[0]]);

        if($cuota['fecha_pago'] != null){
            $fecha_p = explode('-', $cuota['fecha_pago']);
            $fecha_pago = implode("/", [$fecha_p[2],$fecha_p[1],$fecha_p[0]]); 
        }else {
            $fecha_pago = $cuota['fecha_pago'];
        }
        
        $datos = ['cuota' => $cuota, 'pagador' => $nombre_cliente, 'fecha_emision' => $fecha_emision, 'fecha_pago' => $fecha_pago];
        // view()->share(['cuota' => $cuota, 'pagador' => $nombre_cliente, 'fecha_emision' => $fecha_emision, 'fecha_pago' => $fecha_pago]);
        $pdf = \PDF::loadView('cuotas.factura', $datos);

        Mail::send('emails.message-received', $cuota, function ($message) use ($cuota, $pdf) {
            $cuota['asunto'] = "Factura de la cuota - Nosecaen SL";
            $message->to($cuota['email'], $cuota['email'])
                ->subject($cuota["asunto"])
                ->attachData($pdf->output(), $cuota['nombre_factura'].".pdf");
        });
        // $nombre_factura = date('Ymd');
        // return $nombre_factura;
        // return "Mensaje con PDF enviado";

        // return view('cuotas.factura', ['cuota' => $cuota, 'pagador' => $nombre_cliente, 'fecha_emision' => $fecha_emision, 'fecha_pago' => $fecha_pago]);
    }

    // public function enviarEmail(Array $datos, $pdf)
    // {
    //     // Mail::to($datos['email'])->send(new MessageReceived($datos))->attachData($pdf->output(), $datos['nombre_factura'].".pdf");

    //     $datos['asunto'] = "Factura - Nosecaen SL";

    //     Mail::send('emails.message-received', $datos, function ($message) use ($datos, $pdf) {
    //         $message->to($datos['email'], $datos['email'])
    //             ->subject($datos["asunto"])
    //             ->attachData($pdf->output(), $datos['nombre_factura'].".pdf");
    //     });
    // }

    /**
     * Editar cuota
     *
     * @param Cuota $cuota
     * @return void
     */
    public function edit(Cuota $cuota)
    {
        $clientes = Cliente::get();
        return view('cuotas.edit', ['cuota' => $cuota, 'clientes' => $clientes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Cuota $cuota)
    {
        $datos = request()->validate([
            'concepto' => 'required',
            'fecha_emision' => 'required',
            'importe' => 'required|numeric',
            'cliente_id' => 'required',
            'notas' => 'required',
        ]);

        $cuota->update($datos);

        session()->flash('status', 'La cuota se ha actualizado correctamente');

        return to_route('cuotas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuota $cuota)
    {
        $cuota->delete();
        return to_route('cuotas.index');
    }
}
