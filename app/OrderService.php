<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    protected $fillable = [
        'id_order',
        'id_servicio',
        'detalle',
        'monto',
        'descuento',
    ];

    protected $table = 'orders_services';
}
