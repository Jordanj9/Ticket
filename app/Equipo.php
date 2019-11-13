<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = ['id', 'marca', 'procesador', 'memoria_ram', 'disco_duro', 'pantalla', 'licencias', 'anio_adquicision', 'created_at', 'updated_at'];
}
