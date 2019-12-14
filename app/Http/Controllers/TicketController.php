<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Mail\NotificationTicket;
use App\Ticket;
use App\Cliente_Natural;
use App\Cliente_Juridico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
            $tickets = $empleado->tickets;
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
        $clienteNatural = Cliente_Natural::where('identificacion', $request->identificacion)->first();
        $clienteJuridico = Cliente_Juridico::where('nit', $request->nit)->first();
        if ($clienteNatural == null) {
            $clienteNatural = new Cliente_Natural();
            $clienteNatural->nombre = $request->nombre;
            $clienteNatural->apellido = $request->apellido;
            $clienteNatural->identificacion = $request->identificacion;
            $clienteNatural->telefono = $request->telefono;
            $clienteNatural->direccion = $request->direccion;
            $clienteNatural->email = $request->email;
            foreach ($clienteNatural->attributesToArray() as $key => $value) {
                if ($key == 'email') {
                    $clienteNatural->$key = $value;
                } else {
                    $clienteNatural->$key = strtoupper($value);
                }
            }
            $clienteNatural->save();
        }
        if($request->tipopersona == 'JURIDICA'){
            if ($clienteJuridico == null) {
                $clienteJuridico = new Cliente_Juridico();
                $clienteJuridico->nit = $request->nit;
                $clienteJuridico->empresa = $request->empresa;
                $clienteJuridico->direccion = $request->direccionemp;
                $clienteJuridico->email = $request->emailempresa;
                $clienteJuridico->telefono = $request->telefonoemp;
                foreach ($clienteJuridico->attributesToArray() as $key => $value) {
                    if ($key == 'email') {
                        $clienteJuridico->$key = $value;
                    } else {
                        $clienteJuridico->$key = strtoupper($value);
                    }
                }
                $clienteJuridico->save();
            }

        }

        $ticket = new Ticket();
        $hoy = getdate();
        $idr = substr($request->identificacion, -3);
        $ticket->radicado = $idr . $hoy["year"] . $hoy["mon"] . $hoy["mday"] . $hoy["hours"] . $hoy["minutes"] . $hoy["seconds"];
        $ticket->descripcion = strtoupper($request->descripcion);
        $ticket->natural_id = $clienteNatural->id;
        $solicitante = 'NATURAL';
        if($request->tipopersona == 'JURIDICA'){
            $solicitante = 'JURIDICA';
            $ticket->juridica_id = $clienteJuridico->id;
            $ticket->dependencia = $request->dependencia;
        }
        $ticket->solicitante = $solicitante;
        $result = $ticket->save();
        if ($result) {
            $response = "<h5>Señor(a) " . $clienteNatural->nombre . " " . $clienteNatural->apellido . " su ticket ha sido exitoso!</h5><br><h5>Detalles del ticket </h5><p>Fecha de Solicitud: " . $hoy["year"] . "-" . $hoy["mon"] . "-" . $hoy["mday"] . "</p><p>N° de Radicado: <b>" . $ticket->radicado . "</b></p>";
            if($request->tipopersona == 'JURIDICA'){
                $responseJurico = "<h5>Nueva solicitud de tickets!</h5><br><h5>Detalles del ticket </h5><p>Fecha de Solicitud: " . $hoy["year"] . "-" . $hoy["mon"] . "-" . $hoy["mday"] . "</p><p>N° de Radicado: <b>" . $ticket->radicado . "</b></p><p><b>Dependencia: ".$request->dependencia."</b></p><p><b>Observaciòn: ".$ticket->descripcion."</b></p><br><h5>Detalles del Solicitante</h5><br><p><b>Nombre: ".$clienteNatural->nombre." ".$clienteNatural->apellido."</b></p><p><b>Telefono: ".$clienteNatural->telefono."</b></p>";
                Mail::to($clienteJuridico->email)->send(new NotificationTicket($responseJurico));
            }
            Mail::to($clienteNatural->email)->send(new NotificationTicket($response));

            $responseAdmin = "<h5>Señor(a) admin se ha recibido una nueva solicitud de ticket </h5><br><h5>Detalles del ticket </h5><p>Fecha de Solicitud: " . $hoy["year"] . "-" . $hoy["mon"] . "-" . $hoy["mday"] . "</p><p>N° de Radicado: <b>" . $ticket->radicado . "</b></p><br><h5>Detalles del Solicitante</h5><br><p><b>Nombre: ".$clienteNatural->nombre." ".$clienteNatural->apellido."</b></p><p><b>Telefono: ".$clienteNatural->telefono."</b></p>";
            Mail::to('soporte@pctoolsbarrancabermeja.com')->send(new NotificationTicket($responseAdmin));

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
    public function show($id)
    {
          $ticket  = Ticket::find($id);
          return view('general.ticket.show')
              ->with('location','general')
              ->with('ticket',$ticket);
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
        $cliente = Cliente_Natural::where([
            ['identificacion', $identificacion]
        ])->first();

        if ($cliente != null) {
            $obj["id"] = $cliente->identificacion;
            $obj["equipos"] = $cliente->equipos;
            $obj["nom"] = $cliente->nombre;
            $obj["ape"] = $cliente->apellido;
            $obj["tel"] = $cliente->telefono;
            $obj["corr"] = $cliente->email;
            $obj["dir"] = $cliente->direccion;
            $obj["tipo"] = '';
            /*if($cliente->tipopersona == 'JURIDICA'){
                $obj["nit"] = $cliente->nit;
                $obj["empresa"] = $cliente->empresa;
                $obj["dependencia"] = $cliente->dependencia;
                $obj["emailempresa"] = $cliente->emailempresa;
                $obj["telefonoemp"] = $cliente->telefonoemp;
                $obj['direccionemp'] = $cliente->direccionemp;
            }*/
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
    public function consultarJuridica($nit)
    {
        $cliente = Cliente_Juridico::where([
            ['nit', $nit]
        ])->first();

        if ($cliente != null) {

                $obj["nit"] = $cliente->nit;
                $obj["empresa"] = $cliente->empresa;
                $obj["emailempresa"] = $cliente->email;
                $obj["telefonoemp"] = $cliente->telefono;
                $obj['direccionemp'] = $cliente->direccion;
                $obj["equipos"] = $cliente->equipos;

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
        if($ticket->estado == 'FINALIZADO' || $ticket->estado == 'CANCELADO'){
            flash("El Ticket con N° de Radicado: <strong>" . $ticket->radicado . "</strong> no puede ser asignado, debido a su estado actual")->warning();
            return redirect()->route('tickets.index');
        }
        $ticket->empleado_id = $request->empleado_id;
        $ticket->estado = 'ASIGNADO';
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
    public function estado($ticket_id,$estado,$obse){
        $ticket = Ticket::find($ticket_id);
        if($estado == 'FINALIZADO'){
            $ticket->estado = 'FINALIZADO';
            $ticket->observacion = strtoupper($obse);
        }else{
            $ticket->estado = $estado;
        }
        $result = $ticket->save();
        if($result){
            flash("El Ticket con N° de Radicado: <strong>" . $ticket->radicado . "</strong> fue ". $estado." de forma exitosa!")->success();
            return redirect()->route('tickets.index');
        }else{
            flash("El Ticket con N° de Radicado: <strong>" . $ticket->radicado . "</strong> no pudo ser ". $estado."!. Error: ",$result)->error();
            return redirect()->route('tickets.index');
        }
    }
}
