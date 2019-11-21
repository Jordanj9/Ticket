<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use App\Cliente_Juridico;
use App\Cliente_Natural;
use Illuminate\Support\Facades\DB;
use function Sodium\add;

class ReporteController extends Controller
{
    public function index()
    {
        $cj = Cliente_Juridico::all();
        $cn = Cliente_Natural::all();
        $clientes = collect();
        $clientes_j = collect();
        $clientes_n = collect();
        if ($cj != null) {
            foreach ($cj as $value) {
                $clientes[$value->id . "-J"] = "TIPO: JURIDICA - NIT:" . $value->nit . " - " . $value->empresa;
            }
        }
        if ($cn != null) {
            foreach ($cn as $value) {
                $clientes[$value->id . "-N"] = "TIPO: NATURAL - CEDULA:" . $value->identificacion . " - " . $value->nombre . " " . $value->apellido;
            }
        }
        return view('reportes.general')
            ->with('location', 'reporte')
            ->with('clientes', $clientes);
    }

    public function getTickets($estado, $fi, $ff, $cliente)
    {
        // dd([$estado,$fi,$ff,$cliente]);
        $tickets = null;
        $in = explode(",", $fi);
        $fin = explode(",", $ff);
        $inicio = $in[2] . "-" . $in[0] . "-" . $in[1];
        $final = $fin[2] . "-" . $fin[0] . "-" . $fin[1];
        if ($cliente != "null") {
            $cl = explode("-", $cliente);
            if ($cl[1] == "J") {
                $clien = Cliente_Juridico::find($cl[0]);
            } else {
                $clien = Cliente_Natural::find($cl[0]);
            }
            $tic = $clien->tickets;
            //  $b = DB::table('solicituds')->whereBetween('created_at', [$fi, $ff])->where('docente_id', $docente->id)->get();
        } else {
            $tic = Ticket::whereBetween('updated_at', [$inicio, $final])->get();
        }
        $i = strtotime($inicio);
        $f = strtotime($final);
        if ($tic != null) {
            if ($estado != 'TODO') {
                foreach ($tic as $item) {
                    $u = strtotime($item->updated_at);
                    if (($item->estado == $estado) && ($u >= $i && $u <= $f)) {
                        $tickets[] = $item;
                    }
                }
            } else {
                foreach ($tic as $item) {
                    $u = strtotime($item->updated_at);
                    if ($u >= $i && $u <= $f) {
                        $tickets[] = $item;
                    }
                }
            }
            if($tickets != null){
                $response = null;
                foreach ($tickets as $value){
                    $obj['radicado']=$value->radicado;
                    if($value->solicitante == 'JURIDICA'){
                        $obj['cliente']=$value->cliente_juridico->empresa;
                    }else{
                        $obj['cliente']=$value->cliente_natural->nombre." ".$value->cliente_natural->apellido;
                    }
                }
            }else{
                return "null";
            }
        }else{
            return "null";
        }
    }
}
