<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente_Juridico extends Model
{
    protected $table = 'clientes_juridicos';

    protected $fillable = ['id', 'nit', 'empresa', 'direccion', 'email', 'telefono', 'created_at', 'updated_at'];

    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'juridica_id', 'id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'juridica_id');
    }

    public function naturales(){
        return $this->belongsToMany(Cliente_Natural::class,'juridicanaturals','natural_id','juridica_id')
            ->withPivot('dependencia')->withTimestamps();
    }


}
