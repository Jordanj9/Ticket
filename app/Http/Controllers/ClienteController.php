<?php

namespace App\Http\Controllers;

use App\Cliente_Juridico;
use App\Cliente_Natural;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente_Natural::all();
        return view('general.persona_natural.list')
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
     * @param \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente_Natural::find($id);
        return view('general.persona_natural.edit')
            ->with('location', 'general')
            ->with('cliente', $cliente);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente_Natural::find($id);
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
            flash("El Cliente <strong>" . $cliente->nombre . " " . $cliente->apellido . "</strong> fue modificado de forma exitosa!")->success();
            return redirect()->route('natural.index');
        } else {
            flash("El Cliente <strong>" . $cliente->nombre . " " . $cliente->apellido . "</strong> no pudo ser modificado. Error: " . $result)->error();
            return redirect()->route('natural.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
