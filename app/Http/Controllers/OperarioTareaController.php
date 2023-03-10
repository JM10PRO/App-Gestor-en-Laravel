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
        $tareas = Tarea::where('user_id', Auth::user()->id)->where('estado', 'P')->orderByDesc('fechacreacion')->paginate(2);
        foreach ($tareas as $tarea) {
            $fecha_mysql = $tarea->fecharealizacion;
            $objeto_DateTime = DateTime::createFromFormat('Y-m-d', $fecha_mysql);
            $fecha_nuevo_formato = $objeto_DateTime->format("d/m/Y");
            $tarea->fecharealizacion = $fecha_nuevo_formato;
        }
        // if($tareas == null){
        //     dd($tareas);
        // }
        return view('tareas.operario.index', ['tareas' => $tareas]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarea $tarea)
    {
        $provincias = Provincia::get();
        return view('tareas.operario.edit', ['tarea' => $tarea, 'provincias' => $provincias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarea $tarea)
    {
        $request['fechacreacion'] = date('Y-m-d');

        $tarea->update(request()->validate([
            'nif' => 'required',
            'personacontacto' => 'required',
            'telefono' => 'required',
            'correo' => 'required',
            'poblacion' => 'required',
            'codpostal' => 'required',
            'provincia' => 'required',
            'direccion' => 'required',
            'fechacreacion' => '',
            'operario' => 'min:2',
            'fecharealizacion' => 'required|date',
            'anotacionanterior' => 'required',
            'anotacionposterior' => '',
            'estado' => 'required',
            'descripcion' => 'required',
            'ficheroresumen' => 'nullable',
            'fotos' => 'nullable'
        ]));

        session()->flash('status', 'La tarea se ha registrado correctamente');

        return to_route('operario.tareas.index', $tarea);
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
