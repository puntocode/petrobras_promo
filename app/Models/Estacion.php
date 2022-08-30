<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estacion extends Model
{
    //use HasFactory;

    protected $table = 'stations';

    public function razon_social()
    {
        return $this->belongsTo(RazonSocial::class, 'social_reason_id', 'id');
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class, 'zone_id', 'id');
    }

    public function zona_venta()
    {
        return $this->belongsTo(ZonaVenta::class, 'sale_zone_id', 'id');
    }
}
