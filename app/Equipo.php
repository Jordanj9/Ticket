<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $fillable = ['id', 'marca', 'procesador', 'memoria_ram', 'disco_duro', 'pantalla', 'licencias', 'anio_adquicision', 'natural_id', 'juridica_id', 'created_at', 'updated_at'];

    public function cliente_natural(){
        return $this->belongsTo(Cliente_Natural::class);
    }

    public function cliente_juridico(){
        return $this->belongsTo(Cliente_Juridico::class);
    }


    public function mantenimientos(){
        return $this->hasMany(Mantenimiento::class);
    }


}
