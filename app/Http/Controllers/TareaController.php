<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Tarea;
use Carbon\Traits\Date;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SaveTareaRequest;
use App\Http\Requests\SaveIncidenciaRequest;
use App\Models\Cliente;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tarea::orderByDesc('fechacreacion')->paginate(2);
        foreach ($tareas as $tarea) {
            $fecha_creacion_mysql = $tarea->fechacreacion;
            $objeto_DateTime1 = DateTime::createFromFormat('Y-m-d', $fecha_creacion_mysql);
            $fecha_nuevo_formato1 = $objeto_DateTime1->format("d/m/Y");
            $tarea->fechacreacion = $fecha_nuevo_formato1;

            $fecha_realizacion_mysql = $tarea->fecharealizacion;
            $objeto_DateTime2 = DateTime::createFromFormat('Y-m-d', $fecha_realizacion_mysql);
            $fecha_nuevo_formato2 = $objeto_DateTime2->format("d/m/Y");
            $tarea->fecharealizacion = $fecha_nuevo_formato2;
        }
        // En la vista
        return view('tareas.index', ['tareas' => $tareas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provincias = Provincia::get();
        return view('tareas.create', ['tarea' => new Tarea(), 'provincias' => $provincias]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearIncidencia()
    {
        $provincias = Provincia::get();
        return view('tareas.crearincidencia', ['tarea' => new Tarea(), 'provincias' => $provincias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveTareaRequest $request)
    {   
        $request['fechacreacion'] = date('Y-m-d');
        Tarea::create($request->validated());

        // session()->flash('status', 'La tarea se ha registrado correctamente');
        // con With enviamos el mensaje flash
        return to_route('tareas.index')->with('status', 'La tarea se ha registrado correctamente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function guardarIncidencia(SaveIncidenciaRequest $request)
    {   
        return $request->all();
        // HAY QUE VALIDAR SI EL NFIF Y EL TLFN COINCIDE CON LA BD
        $cif_cliente = $request->cif;
        $telefono_cliente = $request->telefono;
        $cliente = Cliente::select()->where('cif',$cif_cliente)->where('telefono',$telefono_cliente)->first();

        if($cliente){
            Tarea::create($request->validated());
            return to_route('home')->with('status', 'La incidencia se ha registrado correctamente');
        }else{
            return view('crearincidencia', ['tarea', $request])->with('status', 'Sus credenciales no coinciden con nuestros datos.');
        }


        // session()->flash('status', 'La tarea se ha registrado correctamente');
        // con With enviamos el mensaje flash
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $tarea)
    {
        $fecha_realizacion = $tarea->fecharealizacion;
        $objeto_DateTime = DateTime::createFromFormat('Y-m-d', $fecha_realizacion);
        $fecha_nuevo_formato = $objeto_DateTime->format("d/m/Y");
        $tarea->fecharealizacion = $fecha_nuevo_formato;
        $fecha_creacion = $tarea->fechacreacion;
        $objeto_DateTime = DateTime::createFromFormat('Y-m-d', $fecha_creacion);
        $fecha2_nuevo_formato = $objeto_DateTime->format("d/m/Y");
        $tarea->fechacreacion = $fecha2_nuevo_formato;
        return view('tareas.show', ['tarea' => $tarea]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarea $tarea)
    {
        $provincias = Provincia::get();
        return view('tareas.edit', ['tarea' => $tarea, 'provincias' => $provincias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveTareaRequest $request, Tarea $tarea)
    {
        $tarea->update($request->validated());

        session()->flash('status', 'La tarea se ha registrado correctamente');

        return to_route('tareas.show', $tarea);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return to_route('tareas.index');
    }
}
