<?php

namespace App\Http\Controllers;

use App\Models\Cuota;
use App\Models\Cliente;
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
    public function guardarCuotaExcepcional(Cuota $cuota, )
    {
        $datos = request()->validate([
            'concepto' => 'required',
            'fecha_emision' => 'required',
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
