<?php

namespace App\Http\Controllers;

use App\Models\Cuota;
use App\Models\Cliente;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class CuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuotas = Cuota::orderByDesc('fecha_emision')->paginate(2);
        $clientes = Cliente::get()->all();
        
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
        $nombre_cliente = Cliente::select('nombre')->where('id', $cuota->cliente_id)->first()->nombre;
        $fecha_e = explode('-', $cuota->fecha_emision);
        $fecha_emision = implode("/", [$fecha_e[2],$fecha_e[1],$fecha_e[0]]);

        if($cuota->fecha_pago != null){
            $fecha_p = explode('-', $cuota->fecha_pago);
            $fecha_pago = implode("/", [$fecha_p[2],$fecha_p[1],$fecha_p[0]]); 
        }else {
            $fecha_pago = $cuota->fecha_pago;
        }

        return view('cuotas.factura', ['cuota' => $cuota, 'pagador' => $nombre_cliente, 'fecha_emision' => $fecha_emision, 'fecha_pago' => $fecha_pago]);
        // return $cuota;
        // view()->share('productos', $productos);
        // $pdf = PDF::loadView('index', $productos);
        // return $pdf->download('archivo-pdf.pdf');
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

        session()->flash('status', 'La cuota se ha añadido correctamente');

        return to_route('cuotas.index');
    }

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
