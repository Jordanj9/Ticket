<?php

namespace App\Http\Controllers;

use App\Cliente_Juridico;
use App\Cliente_Natural;
use Illuminate\Http\Request;

class JuridicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente_Juridico::all();
        return view('general.persona_juridica.list')
            ->with('location', 'general')
            ->with('clientes', $clientes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente_Juridico::find($id);
        return view('general.persona_juridica.edit')
            ->with('location', 'general')
            ->with('cliente', $cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente_Juridico::find($id);
        foreach ($cliente->attributesToArray() as $key => $value) {
            if (isset($request->$key)) {
                if ($key == 'email') {
                    $cliente->$key = $request->$key;
                } else {
                    $cliente->$key = strtoupper($request->$key);
                }
            }
        }
        $result = $cliente->save();
        if ($result) {
            flash("El Cliente <strong>" . $cliente->empresa . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('juridica.index');
        } else {
            flash("El Cliente <strong>" . $cliente->empresa . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('juridica.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
