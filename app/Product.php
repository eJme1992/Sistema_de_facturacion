<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id_categoria',
        'codigo',
        'nombre',
        'pedido',
        'quedan',
        'costo',
        'monto',
        'archivo',
    ];
}
