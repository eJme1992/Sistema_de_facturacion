@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>
                            You are logged in!
                    </p>
                    <p>
                            Partamos realizando una nueva copia de Laravel 5.5: Fuente de la imagen: 
                            Luego ejecutar el comando php artisan para crear el recurso de autenticación 
                            php artisan make:auth. Crear el modelo Role con su respectiva migración
                    </p>
                    <p>
                            Partamos realizando una nueva copia de Laravel 5.5: Fuente de la imagen: 
                            Luego ejecutar el comando php artisan para crear el recurso de autenticación 
                            php artisan make:auth. Crear el modelo Role con su respectiva migración
                    </p>
                    <p>
                            Partamos realizando una nueva copia de Laravel 5.5: Fuente de la imagen: 
                            Luego ejecutar el comando php artisan para crear el recurso de autenticación 
                            php artisan make:auth. Crear el modelo Role con su respectiva migración
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
