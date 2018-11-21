<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $fillable = [
        'id_order',
        'id_producto',
        'cantidad',
        'monto',
    ];

    protected $table = 'orders_products';
}
