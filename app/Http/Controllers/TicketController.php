<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\Cliente;
use Illuminate\Http\Request;

class TicketController extends Controller
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
        dd($request);
        $existe = Cliente::where('identificacion', $request->identificacion)->first();
        if ($existe == null) {
            if ($request->tipopersona == 'JURIDICA') {
                $cliente = new Cliente($request->all());
            } else {
                $cliente = new Cliente();
                $cliente->tipopersona = $request->tipopersona;
                $cliente->nombre = $request->nombre;
                $cliente->apellido = $request->apellido;
                $cliente->identificacion = $request->identificacion;
                $cliente->telefono = $request->telefono;
                $cliente->direccion = $request->direccion;
                $cliente->email = $request->email;
            }
            foreach ($cliente->attributesToArray() as $key => $value) {
                if ($key == 'email') {
                    $cliente->$key = $value;
                } else {
                    $cliente->$key = strtoupper($value);
                }
            }
            $cliente->save();
        } else {
            $ticket = new Ticket();
            $ticket->descripcion = strtoupper($request->descripcion);
            $ticket->cliente_id;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
