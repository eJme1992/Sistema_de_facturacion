<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facturar extends Model 
{
    static function facturar() 
    {
        $caja_abierta = \DB::table('controls')->where('caja_abierta', 1)->exists();
        
        if ($caja_abierta) 
        {
            $tipo = "servicios";
            $id_type = 2;
            $empleados = \DB::table('users')->select('id', 'nombre', 'activo')->where([['id_uType', "!=", 3], ['id', "!=", 1], ])->orderBy('nombre')->get();
            $clientes = \DB::table('users')->select('id', 'nombre', 'activo')->where('id_uType', 3)->orderBy('nombre')->get();
            $formasPago = \DB::table('formas_pago')->select('id', 'nombre')->get();
            $_SESSION['caja_abierta'] = $caja_abierta;
            $_SESSION['empleados'] = $empleados;
            $_SESSION['clientes'] = $clientes;
            $_SESSION['id_type'] = $id_type;
            $_SESSION['tipo'] = $tipo;
        }
    }
}
