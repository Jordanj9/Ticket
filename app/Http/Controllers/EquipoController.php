<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipos = Equipo::all();
        return view('general.equipos.list')
            ->with('equipos',$equipos)
            ->with('location','general');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('general.equipos.create')
            ->with('location','general')
            ->with('clientes',$clientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $equipo = new Equipo($request->all());
        foreach ($equipo->attributesToArray() as $key => $value) {
            if ($key == 'licencias') {
                $equipo->$key = $value;
            } else {
                $equipo->$key = strtoupper($value);
            }
        }
        $result = $equipo->save();

        if($result){
            flash("El Equipo <strong>" .$equipo->id .''.$equipo->marca . "-" . $equipo->procesador. "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('equipos.index');
        }else{
            flash("El Equipo <strong>" . $equipo->id .''.$equipo->marca . "-" . $equipo->procesador . "</strong>no pudo ser almacenado de forma exitosa!")->success();
            return redirect()->route('equipos.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function show(Equipo $equipo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clientes = Cliente::all();
        $equipo = Equipo::find($id);
        return view('general.equipos.edit')
            ->with('location', 'general')
            ->with('equipo', $equipo)
            ->with('clientes',$clientes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $equipo = Equipo::find($id);
        foreach ($equipo->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                if ($key == 'licencias') {
                    $equipo->$key = $request->$key;
                } else {
                    $equipo->$key = strtoupper($request->$key);
                }
            }
        }
        $result = $equipo->save();

        if($result){
            flash("El Equipo <strong>" .$equipo->id .' '.$equipo->marca . "-" . $equipo->procesador. "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('equipos.index');
        }else{
            flash("El Equipo <strong>" . $equipo->id .' '.$equipo->marca . "-" . $equipo->procesador . "</strong>no pudo ser modificado de forma exitosa!")->success();
            return redirect()->route('equipos.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $equipo = Equipo::find($id);
        if (count($equipo->mantenimientos) > 0) {
            flash("El Equipo <strong>" . $equipo->id . ' ' . $equipo->marca . "-" . $equipo->procesador . "</strong> no pudo ser eliminado porque tiene mantenimientos asociados.")->warning();
            return redirect()->route('equipos.index');
        } else {
            $result = $equipo->delete();
            if ($result) {

                flash("El Equipo <strong>" . $equipo->id . ' ' . $equipo->marca . "-" . $equipo->procesador . "</strong> fue eliminado de forma exitosa!")->success();
                return redirect()->route('equipos.index');
            } else {
                flash("El Equipo <strong>" . $equipo->id . '-' . $equipo->marca . "-" . $equipo->procesador . "</strong> no pudo ser eliminado. Error: " . $result)->error();
                return redirect()->route('equipos.index');
            }
        }

    }

}
