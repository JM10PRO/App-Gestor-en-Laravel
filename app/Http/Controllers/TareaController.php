<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveTareaRequest;
use App\Models\Provincia;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tarea::paginate(10);
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
        return view('tareas.create', ['tarea' => new Tarea(),'provincias' => $provincias]);
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

        session()->flash('status', 'La tarea se ha registrado correctamente');
        
        return to_route('tareas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $tarea)
    {
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
    public function destroy($id)
    {
        //
    }
}
