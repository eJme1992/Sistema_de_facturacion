<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'firebase' => [
        'api_key' => 'AIzaSyDKqWy4TrSriABnc8xqzZQNm_MWUQ8yocU', // ESTA LA PODEMOS OBTENER PRESIONANDO Agregar Firebase a tu app web     
        'auth_domain' => 'cisca-2c258.firebaseapp.com',  // ESTA LA PODEMOS OBTENER PRESIONANDO Agregar Firebase a tu app web     
        'database_url' => 'https://cisca-2c258.firebaseio.com', // ESTA LA PODEMOS OBTENER PRESIONANDO Agregar Firebase a tu app web
        'secret' => 'KHnV4Sf2C4yq3JA0xTBSJZ0TP7Yc7W5759uDjQQx', // Esta la sacamos dirigiendonos a la seccion Cuentas de Servicio
        'storage_bucket' => 'cisca-2c258.appspot.com',  // ESTA LA PODEMOS OBTENER PRESIONANDO Agregar Firebase a tu app web
    ],
];
