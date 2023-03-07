<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SaveEmpleadoRequest;

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
        return view('empleados.create', ['empleado' => new User()]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveEmpleadoRequest $request)
    {   
        User::create([
            'name' => $request->name,
            'nif' => $request->nif,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'role' => $request->role,
        ]);

        // session()->flash('status', 'La tarea se ha registrado correctamente');
        // con With enviamos el mensaje flash
        return to_route('empleados.index')->with('status', 'El empleado se ha guardado correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $empleado)
    {
        return view('empleados.edit', ['empleado' => $empleado]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $empleado)
    {
        $datos = request()->validate([
            'name' => 'required',
            'nif' => 'required',
            'email' => 'required|email',
            'password' => '',
            'telefono' => 'required',
            'direccion' => 'required',
            'role' => 'required',
        ]);

        if($datos['password'] != null){
            $datos['password'] = Hash::make($datos['password']);
        }else {
            unset($datos['password']);
        }

        $empleado->update($datos);

        session()->flash('status', 'El empleado se ha actualizado correctamente');

        return to_route('empleados.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $empleado)
    {
        $empleado->delete();

        session()->flash('status', 'El empleado se ha eliminado exitosamente');

        return to_route('empleados.index');
    }
}
