<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Ticket;
use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp = Empleado::all();
        $empleados = collect();
        if ($emp != null) {
            foreach ($emp as $e) {
                $empleados[$e->id] = $e->identificacion . " " . $e->nombre . " " . $e->apellido;
            }
        }
        $u = Auth::user();
        $empleado = Empleado::where('identificacion',$u->identificacion)->first();
        if($empleado != null){
            $tickets = $empleado->tickets();
        }else{
            $tickets = Ticket::all();
        }
        return view('general.ticket.list')
            ->with('location', 'general')
            ->with('tickets', $tickets)
            ->with('empleados', $empleados);
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
        $cliente = Cliente::where('identificacion', $request->identificacion)->first();
        if ($cliente == null) {
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
                if ($key == 'email' || $key == 'emailempresa') {
                    $cliente->$key = $value;
                } else {
                    $cliente->$key = strtoupper($value);
                }
            }
            $cliente->save();
        }
        $ticket = new Ticket();
        $hoy = getdate();
        $idr = substr($request->identificacion, -3);
        $ticket->radicado = $idr . $hoy["year"] . $hoy["mon"] . $hoy["mday"] . $hoy["hours"] . $hoy["minutes"] . $hoy["seconds"];
        $ticket->descripcion = strtoupper($request->descripcion);
        $ticket->cliente_id = $cliente->id;
        $result = $ticket->save();
        if ($result) {
            $response = "<h5>Señor(a) " . $cliente->nombre . " " . $cliente->apellido . " su ticket ha sido exitoso!</h5><br><h5>Detalles del ticket </h5><p>Fecha de Solicitud: " . $hoy["year"] . "-" . $hoy["mon"] . "-" . $hoy["mday"] . "</p><p>N° de Radicado: <b>" . $ticket->radicado . "</b></p>";
            return response()->json([
                'response' => $response,
                'status' => 'ok'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
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

    /**
     * Get a specific App/Cliente
     *
     * @param \App\Cliente $identificacion
     * @return \Illuminate\Http\Response Json
     */
    public function consultar($identificacion)
    {
        $cliente = Cliente::where('identificacion', $identificacion)->first();
        if ($cliente != null) {
            $obj["id"] = $cliente->identificacion;
            $obj["nom"] = $cliente->nombre;
            $obj["ape"] = $cliente->apellido;
            $obj["tel"] = $cliente->telefono;
            $obj["corr"] = $cliente->email;
            $obj["dir"] = $cliente->direccion;
            $obj["tipo"] = $cliente->tipopersona;
            return response()->json([
                'response' => $obj,
                'status' => 'ok'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }

    /**
     * Asignar ticket a empleado
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function asignar(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);
        $ticket->empleado_id = $request->empleado_id;
        $result = $ticket->save();
        if ($result) {
            flash("El Ticket con N° de Radicado: <strong>" . $ticket->radicado . "</strong> le fue asignado al empleado de forma exitosa!")->success();
            return redirect()->route('tickets.index');
        } else {
            flash("El Ticket con N° de Radicado: <strong>" . $ticket->radicado . "</strong> no pudo ser asignado. Error: " . $result)->error();
            return redirect()->route('tickets.index');
        }
    }

    /**
     * Cambiar estado de ticket (aplazar,finalizar,cancelar)
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function estado(Request $request){
        dd($request);
        $ticket = Ticket::find($request->ticket_id);
        if($request->estado == 'FINALIZADO'){
            $ticket->estado == 'FINALIZADO';
            $ticket->observacion == strtoupper($request->observacion);
        }else{
            $ticket->estado == $request->estado;
        }
        $result = $ticket->save();
        if($result){
            flash("El Ticket con N° de Radicado: <strong>" . $ticket->radicado . "</strong> fue ". $request->estado." de forma exitosa!")->success();
            return redirect()->route('tickets.index');
        }else{
            flash("El Ticket con N° de Radicado: <strong>" . $ticket->radicado . "</strong> no pudo ser ". $request->estado."!. Error: ",$result)->error();
            return redirect()->route('tickets.index');
        }
    }
}
