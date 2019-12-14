<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use App\Cliente_Juridico;
use App\Cliente_Natural;
use Barryvdh\DomPDF\Facade as PDF;
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
        //dd([$estado,$fi,$ff,$cliente]);
        $tickets = null;
        $in = explode(",", $fi);
        $fin = explode(",", $ff);
        $inicio = $in[2] . "-" . $in[0] . "-" . $in[1];
        $final = $fin[2] . "-" . $fin[0] . "-" . $fin[1];
        $final = strtotime($final);
        $final = strtotime("+1 day", $final);
        $final = date('Y-m-d', $final);
        if ($cliente != "null") {
            $cl = explode("-", $cliente);
            if ($cl[1] == "J") {
                $clien = Cliente_Juridico::find($cl[0]);
                $nombrecli = $clien->empresa;
            } else {
                $clien = Cliente_Natural::find($cl[0]);
                $nombrecli = $clien->nombre . " " . $clien->apellido;
            }
            $tic = $clien->tickets;
        } else {
            $tic = Ticket::whereBetween('updated_at', [$inicio, $final])->get();
            $nombrecli = 'TODOS';
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
        }
        if ($tickets != null) {
            $response = null;
            foreach ($tickets as $value) {
                $obj['radicado'] = $value->radicado;
                if ($value->solicitante == 'JURIDICA') {
                    $obj['cliente'] = $value->cliente_juridico->empresa;
                    $obj['documento'] = $value->cliente_juridico->nit;
                    $obj['dependencia'] = $value->dependencia;
                } else {
                    $obj['cliente'] = $value->cliente_natural->nombre . " " . $value->cliente_natural->apellido;
                    $obj['documento'] = $value->cliente_natural->identificacion;
                    $obj['dependencia'] = "NO APLICA";
                }
                $obj['tipo'] = $value->solicitante;
                $obj['solicitante'] = $value->cliente_natural->nombre . " " . $value->cliente_natural->apellido;
                $fecha = explode(" ", $value->updated_at);
                $obj['fecha'] = $fecha[0];
                $obj['estado'] = $value->estado;
                if ($value->observacion == null) {
                    $obj['descripcion'] = "--";
                } else {
                    $obj['descripcion'] = $value->observacion;
                }
                $response[] = $obj;
            }
            if ($response != null) {
                if (count($response) > 0) {
                    $arror = $this->orderMultiDimensionalArray($response, 'cliente', false);
                    $encabezado = null;
                    $cabeceras = ['Radicado', 'Cliente', 'Documento', 'Dependencia', 'Tipo','solicitante', 'Fecha', 'Estado', 'Observación'];
                    $filtros = [
                        'ESTADO' => $estado,
                        'DESDE' => $inicio,
                        'HASTA' => $final,
                        'CLIENTE' => $nombrecli
                    ];
                    $hoy = getdate();
                    $fechar = $hoy["year"] . "/" . $hoy["mon"] . "/" . $hoy["mday"] . "  Hora: " . $hoy["hours"] . ":" . $hoy["minutes"] . ":" . $hoy["seconds"];
                    $date['fecha'] = $fechar;
                    $date['encabezado'] = $encabezado;
                    $date['cabeceras'] = $cabeceras;
                    $date['data'] = $arror;
                    $date['nivel'] = 1;
                    $date['titulo'] = "REPORTES DE TICKETS - LISTADO DE CLIENTES GENERAL";
                    $date['filtros'] = $filtros;
                    //$pdf = Pdf::loadView('reportes.print_1_2_niveles', $date);
                   //composer require barryvdh/laravel-dompdf
                    $pdf = PDF::loadView('reportes.print_1_2_niveles', $date);
                    return $pdf->stream('reporte.pdf');
                } else {
                    return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
                }
            } else {
                return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
            }
        } else {
            return "<p style='position: absolute; top:50%; left:50%; width:400px; margin-left:-200px; height:150px; margin-top:-150px; border:3px solid #2c3e50; background-color:#f0f3f4; padding:40px; font-size:30px; color:red;'>Su consulta no produjo resultados.<br/><br/></p>";
        }
    }

    function orderMultiDimensionalArray($toOrderArray, $field, $inverse = false)
    {
        $position = array();
        $newRow = array();
        foreach ($toOrderArray as $key => $row) {
            $position[$key] = $row[$field];
            $newRow[$key] = $row;
        }
        if ($inverse) {
            arsort($position);
        } else {
            asort($position);
        }
        $returnArray = array();
        foreach ($position as $key => $pos) {
            $returnArray[] = $newRow[$key];
        }
        return $returnArray;
    }
}
