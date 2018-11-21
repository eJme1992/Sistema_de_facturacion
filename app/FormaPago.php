<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    protected $fillable = [
        'nombre',
    ];

    protected $table = 'formas_pago';
}
