<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Ticket;
use App\User;
use App\Grupousuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::all();
        return view('general.empleado.list')
            ->with('location', 'general')
            ->with('empleados', $empleados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general.empleado.create')
            ->with('location', 'general');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $existe = Empleado::where('identificacion', $request->identificacion)->first();
        if ($existe != null) {
            flash("El Empleado con la identificación <strong>" . $request->identificacion . "</strong> ya existe. Atención!")->warning();
            return redirect()->route('empleado.index');
        } else {
            $empleado = new Empleado($request->all());
            foreach ($empleado->attributesToArray() as $key => $value) {
                if ($key == 'email') {
                    $empleado->$key = $value;
                } else {
                    $empleado->$key = strtoupper($value);
                }
            }
            $result = $empleado->save();
            if ($result) {
                $u = Auth::user();
                $user = new User();
                $user->identificacion = $empleado->identificacion;
                $user->estado = "ACTIVO";
                $user->email = $empleado->email;
                $user->password = bcrypt($empleado->identificacion);
                $user->nombres = $empleado->nombre;
                $user->apellidos = $empleado->apellido;
                $user->save();
                $g = Grupousuario::where('nombre', 'EMPLEADO')->first();
                $user->grupousuarios()->sync($g->id);
                flash("El Empleado <strong>" . $empleado->nombre . " " . $empleado->apellido . "</strong> fue almacenado de forma exitosa!")->success();
                return redirect()->route('empleado.index');
            } else {
                flash("El Empleado  <strong>" . $empleado->nombre . " " . $empleado->apellido . "</strong> no pudo ser almacenado. Error: " . $result)->error();
                return redirect()->route('empleado.index');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Empleado $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Empleado $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::find($id);
        return view('general.empleado.edit')
            ->with('location', 'general')
            ->with('empleado', $empleado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Empleado $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleado::find($id);
        foreach ($empleado->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                if ($key == 'email') {
                    $empleado->$key = $request->$key;
                } else {
                    $empleado->$key = strtoupper($request->$key);
                }
            }
        }
        $result = $empleado->save();
        if ($result) {
            $u = Auth::user();
            $user = User::where('identificacion', $empleado->identificacion)->first();
            foreach ($user->attributesToArray() as $key => $value) {
                if (isset($request->$key)) {
                    if ($key == 'email') {
                        $user->$key = $request->$key;
                    } else {
                        $user->$key = strtoupper($request->$key);
                    }
                }
            }
            $user->save();
            flash("El Empleado <strong>" . $empleado->nombre . " " . $empleado->apellido . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('empleado.index');
        } else {
            flash("El Empleado <strong>" . $empleado->nombre . " " . $empleado->apellido . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('empleado.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Empleado $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        if (count($empleado->tickets) > 0) {
            flash("El Docente <strong>" . $empleado->nombre . " " . $empleado->apellido . "</strong> no pudo ser eliminado porque tiene tickest asociados.")->warning();
            return redirect()->route('empleado.index');
        } else {
            $result = $empleado->delete();
            if ($result) {
                $user = User::where('identificacion', $empleado->identificacion)->first();
                $user->delete();
                flash("El Empleado <strong>" . $empleado->nombre . " " . $empleado->apellido . "</strong> fue eliminado de forma exitosa!")->success();
                return redirect()->route('empleado.index');
            } else {
                flash("El Empleado <strong>" . $empleado->nombre . " " . $empleado->apellido . "</strong> no pudo ser eliminado. Error: " . $result)->error();
                return redirect()->route('empleado.index');
            }
        }
    }
}
