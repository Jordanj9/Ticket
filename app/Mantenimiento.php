<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    protected $fillable = ['id', 'descripcion', 'equipo_id', 'empleado_id', 'created_at'];

    public function equipo(){
        return $this->belongsTo(Equipo::class);
    }

    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }

}
