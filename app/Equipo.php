<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = ['id', 'marca', 'procesador', 'memoria_ram', 'disco_duro', 'pantalla', 'licencias', 'anio_adquicision', 'cliente_id','created_at', 'updated_at'];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function mantenimientos(){
        return $this->hasMany(Mantenimiento::class);
    }


}
