<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Tarea;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SaveTareaRequest;
use App\Http\Requests\SaveIncidenciaRequest;

class OperarioTareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tarea::where('user_id', Auth::user()->id)->orderByDesc('fechacreacion')->paginate(2);
        foreach ($tareas as $tarea) {
            $fecha_mysql = $tarea->fecharealizacion;
            $objeto_DateTime = DateTime::createFromFormat('Y-m-d', $fecha_mysql);
            $fecha_nuevo_formato = $objeto_DateTime->format("d/m/Y");
            $tarea->fecharealizacion = $fecha_nuevo_formato;
        }
        return view('tareas.index', ['tareas' => $tareas]);
        // $tareas = Tarea::paginate(10);
        // foreach ($tareas as $tarea) {
        //     $fecha_mysql = $tarea->fecharealizacion;
        //     $objeto_DateTime = DateTime::createFromFormat('Y-m-d', $fecha_mysql);
        //     $fecha_nuevo_formato = $objeto_DateTime->format("d/m/Y");
        //     $tarea->fecharealizacion = $fecha_nuevo_formato;
        // }
        // return view('tareas.index', ['tareas' => $tareas]);
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
        Tarea::create($request->validated());

        // session()->flash('status', 'La tarea se ha registrado correctamente');
        // con With enviamos el mensaje flash
        return to_route('home')->with('status', 'La incidencia se ha registrado correctamente');
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
    public function deleteConfirmation(Tarea $tarea)
    {
        $fecha_realizacion = $tarea->fecharealizacion;
        $objeto_DateTime = DateTime::createFromFormat('Y-m-d', $fecha_realizacion);
        $fecha_nuevo_formato = $objeto_DateTime->format("d/m/Y");
        $tarea->fecharealizacion = $fecha_nuevo_formato;
        $fecha_creacion = $tarea->fechacreacion;
        $objeto_DateTime = DateTime::createFromFormat('Y-m-d', $fecha_creacion);
        $fecha2_nuevo_formato = $objeto_DateTime->format("d/m/Y");
        $tarea->fechacreacion = $fecha2_nuevo_formato;
        return view('tareas.deleteconfirmation', ['tarea' => $tarea]);
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
        return $tarea;
    }
}
