<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Show the view menu usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function usuarios()
    {
        return view('menu.usuarios')->with('location', 'usuarios');
    }

    public function general()
    {
        return view('menu.general')->with('location', 'general');
    }

    public function mantenimiento()
    {
        return view('menu.mantenimiento')->with('location', 'mantenimiento');
    }

    public function reporte()
    {
        return view('menu.reporte')->with('location', 'reporte');
    }

}
