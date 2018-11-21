@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills nav-fill">
                            {{-- <li class="nav-item">
                                <a class="nav-link active" href="/admin">Inicio</a>
                            </li> --}}
                            
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/clientes">Clientes</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/empleados">Empleados</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/encargados">Encargados</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/servicios">Servicios</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/productos">Productos</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/control">Control</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                    
                        @yield('content2')
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection