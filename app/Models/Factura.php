<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    //use HasFactory;

    protected $table = "redeems";

    public $timestamps = false;

    public function cliente()
    {
        return $this->belongsTo('App\Models\Cliente', 'user_id', 'id');
    }

    public function estacion()
    {
        return $this->belongsTo('App\Models\Estacion', 'station_id', 'id');
    }
}
