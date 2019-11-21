<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente_Natural extends Model
{

    protected $table = 'clientes_naturales';

    protected $fillable = [
        'id', 'identificacion', 'nombre', 'apellido', 'telefono', 'email', 'direccion', 'created_at', 'updated_at'
    ];

    public function equipos(){
        return $this->hasMany(Equipo::class,'natural_id','id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
