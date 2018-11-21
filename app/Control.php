<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Control extends Model
{
    protected $fillable = [
        'id_desc', 
        'admin', 
        'detalle', 
        'monto', 
        'caja_abierta',
    ];
}
