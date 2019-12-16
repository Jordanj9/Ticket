<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cliente_Juridico;
use App\Cliente_Natural;
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
            ->with('equipos', $equipos)
            ->with('location', 'general');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientesNaturales = Cliente_Natural::all();
        $clientesJuridicos = Cliente_Juridico::all();
        $clientes = collect();

        foreach ($clientesNaturales as $item) {

            $clientes[] = [
                'id' => $item->id,
                'identificacion' => $item->identificacion,
                'nombre' => $item->nombre . ' ' . $item->apellido,
                'tipo' => 'NATURAL'
            ];

        }

        foreach ($clientesJuridicos as $item) {

            $clientes[] = [
                'id' => $item->id,
                'identificacion' => $item->nit,
                'nombre' => $item->empresa,
                'tipo' => 'JURIDICA'
            ];

        }

        return view('general.equipos.create')
            ->with('location', 'general')
            ->with('clientes', $clientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $equipo = new Equipo($request->all());

        if($request->tipo == 'NATURAL'){
             $equipo->natural_id =  $request->cliente_id;
             $equipo->propietario = 'NATURAL';
        }else{
            $equipo->juridica_id = $request->cliente_id;
            $equipo->propietario = 'JURIDICA';
        }

        foreach ($equipo->attributesToArray() as $key => $value) {
            if ($key == 'licencias') {
                $equipo->$key = $value;
            } else {
                $equipo->$key = strtoupper($value);
            }
        }
        $result = $equipo->save();

        if ($result) {
            flash("El Equipo <strong>" . $equipo->id . '' . $equipo->marca . "-" . $equipo->procesador . "</strong> fue almacenado de forma exitosa!")->success();
            return redirect()->route('equipos.index');
        } else {
            flash("El Equipo <strong>" . $equipo->id . '' . $equipo->marca . "-" . $equipo->procesador . "</strong>no pudo ser almacenado de forma exitosa!")->success();
            return redirect()->route('equipos.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Equipo $equipo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $equipo = Equipo::find($id);
        return view('general.equipos.show')
               ->with('location','general')
               ->with('equipo',$equipo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Equipo $equipo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clientesNaturales = Cliente_Natural::all();
        $clientesJuridicos = Cliente_Juridico::all();
        $clientes = collect();

        foreach ($clientesNaturales as $item) {

            $clientes[] = [
                'id' => $item->id,
                'identificacion' => $item->identificacion,
                'nombre' => $item->nombre . ' ' . $item->apellido,
                'tipo' => 'NATURAL'
            ];

        }

        foreach ($clientesJuridicos as $item) {

            $clientes[] = [
                'id' => $item->id,
                'identificacion' => $item->nit,
                'nombre' => $item->empresa,
                'tipo' => 'JURIDICA'
            ];
        }

        $equipo = Equipo::find($id);
        $newEquipo = [];

        if($equipo->propietario == "NATURAL"){
            $cliente = [
                'id' => $equipo->cliente_natural->id,
                'identificacion' => $equipo->cliente_natural->identificacion,
                'nombre' =>  $equipo->cliente_natural->nombre.' '.$equipo->cliente_natural->apellido,
                'tipo' => 'NATURAL'
            ];
        }else{
            $cliente = [
                'id' => $equipo->cliente_juridico->id,
                'identificacion' => $equipo->cliente_juridico->nit,
                'nombre' =>  $equipo->cliente_juridico->empresa,
                'tipo' => 'JURIDICA'
            ];
        }

        return view('general.equipos.edit')
            ->with('location', 'general')
            ->with('equipo', $equipo)
            ->with('clientes', $clientes)
            ->with('cliente',$cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Equipo $equipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $equipo = Equipo::find($id);

        if($request->tipo == 'NATURAL'){
            $equipo->natural_id =  $request->cliente_id;
            $equipo->propietario = 'NATURAL';
        }else{
            $equipo->juridica_id = $request->cliente_id;
            $equipo->propietario = 'JURIDICA';
        }

        foreach ($equipo->attributesToArray() as $key => $value) {
            if ($key == 'licencias') {
                $equipo->$key = $value;
            } else {
                if($key != 'juridica_id' || $key != 'natural_id'){
                    $equipo->$key = strtoupper($value);
                }
            }
        }
        $result = $equipo->save();

        if ($result) {
            flash("El Equipo <strong>" . $equipo->id . ' ' . $equipo->marca . "-" . $equipo->procesador . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('equipos.index');
        } else {
            flash("El Equipo <strong>" . $equipo->id . ' ' . $equipo->marca . "-" . $equipo->procesador . "</strong>no pudo ser modificado de forma exitosa!")->success();
            return redirect()->route('equipos.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Equipo $equipo
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
