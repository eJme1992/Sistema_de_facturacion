<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mpociot\Firebase\SyncsWithFirebase;

class Service extends Model
{
    //use SyncsWithFirebase;

    protected $fillable = [
        'nombre','monto',
    ];
}
