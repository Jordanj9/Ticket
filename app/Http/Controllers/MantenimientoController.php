<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Mantenimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MantenimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('mantenimiento.create')
            ->with('location','mantenimiento');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleado = Empleado::where('identificacion',Auth::user()->identificacion)->first();

        if($empleado != null){

            $request->empleado_id = $empleado->id;
            $mantenimiento = new Mantenimiento($request->all());
            foreach ($mantenimiento->attributesToArray() as $key => $value) {
                $mantenimiento->$key = strtoupper($value);
            }
            $result = $mantenimiento->save();

            if($result){

                return response()->json([
                    'status' => 'ok',
                    'message' => 'El mantenimiento fue almacenado correctamente'
                ]);

            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error inesperado, no se pudo almacenar correctamente el mantenimiento, por favor intentelo mas tarde'
                ]);
            }

        }else{

            $mantenimiento = new Mantenimiento($request->all());
            foreach ($mantenimiento->attributesToArray() as $key => $value) {
                $mantenimiento->$key = strtoupper($value);
            }
            $result = $mantenimiento->save();

            if($result){

                return response()->json([
                    'status' => 'ok',
                    'message' => 'El mantenimiento fue almacenado correctamente'
                ]);

            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error inesperado, no se pudo almacenar correctamente el mantenimiento, por favor intentelo mas tarde'
                ]);
            }
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function show(Mantenimiento $mantenimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Mantenimiento $mantenimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mantenimiento $mantenimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mantenimiento  $mantenimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mantenimiento $mantenimiento)
    {
        //
    }
}
