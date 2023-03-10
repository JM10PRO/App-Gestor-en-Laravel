<?php

namespace App\Http\Controllers;

use App\Models\Pais;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\SaveClienteRequest;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::paginate(5);
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
        return view('clientes.index', ['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::orderBy('nombre')->get();
        return view('clientes.create', ['cliente' => new Cliente(), 'paises' => $paises]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $pais = request()->pais_id;
        $moneda = Pais::select('iso_moneda')->where('id', $pais)->first()->iso_moneda;
        $request['moneda'] = $moneda;
        
        $datos = request()->validate([
            'cif' => 'required|min:9|max:10',
            'nombre' => 'required',
            'telefono' => 'required|numeric',
            'correo' => 'required|email',
            'cuota_mensual' => 'required|numeric',
            'cuenta_corriente' => 'required',
            'pais_id' => 'required',
        ]);

        $datos['moneda'] = $moneda;

        Cliente::create($datos);

        return to_route('clientes.index')->with('status', 'El cliente se ha agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        $id_pais = $cliente->pais_id;
        $pais = Pais::select('nombre')->where('id', $id_pais)->first()->nombre;
        $moneda = Pais::select('nombre_moneda')->where('id', $id_pais)->first()->nombre_moneda;
        
        if($moneda == null){
            $moneda = '-';
        }
        
        return view('clientes.show', [
            'cliente' => $cliente, 
            'pais' => $pais,
            'moneda' => $moneda
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return to_route('clientes.index');
    }
}
