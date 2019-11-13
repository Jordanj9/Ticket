<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'tipopersona', 'identificacion', 'nombre', 'apellido', 'telefono', 'email', 'direccion', 'nit', 'empresa', 'direccionemp', 'dependencia', 'emailempresa', 'telefonoemp', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
