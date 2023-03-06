<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = User::paginate(2);
        foreach ($empleados as $empleado) {
            $rol = $empleado->role;
            if($rol == 0){
                $rol = 'Admin';
            }elseif($rol == 1){
                $rol = 'Operario';
            }else{
                $rol = 'Cliente';
            }
            $empleado->role = $rol;
        }
        return view('empleados.index', ['empleados' => $empleados]);
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
