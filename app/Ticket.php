<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'radicado', 'descripcion', 'estado', 'observacion', 'dependencia', 'empleado_id', 'natural_id', 'juridica_id', 'solicitante', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    public function cliente_natural()
    {
        return $this->belongsTo(Cliente_Natural::class,'natural_id');
    }

    public function cliente_juridico()
    {
        return $this->belongsTo(Cliente_Juridico::class,'juridica_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }

}
