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
                            <?php $caja_abierta = $_SESSION['caja_abierta']; ?>
                           
                           @if($caja_abierta==1)
                            <li class="nav-item">
                                 <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalEJ">Facturar</button>
                            </li>
                            @endif
                            
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
    <!-- Modal -->
@if($caja_abierta==1)
    <?php 
    
    $empleados =   $_SESSION['empleados'];
    $clientes = $_SESSION['clientes'];
    $id_type =   $_SESSION['id_type'];
    $tipo = $_SESSION['tipo'];
    ?>
  <div class="modal fade" id="myModalEJ" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Facturar</h4>
        </div>
        <div class="modal-body row">
            <div class="col-md-12">
              <form method="POST" action="/admin/control/ingresos/{{$tipo}}">
                        {!!csrf_field()!!}

                        <div class="form-group col-md-3" style="padding-left: 0px;">
                            <label>Atendió</label>
                            <select class="form-control text-uppercase text-uppercase" name="id_empleado" value="{{ old('id_empleado') }}">
                                @foreach($empleados as $empleado)
                                    @if($empleado->activo == 1)
                                    <option value="{{$empleado->id}}">{{$empleado->nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3" style="padding-left: 0px;">
                            <label>Cliente</label>
                            <select class="form-control text-uppercase" name="id_cliente" value="{{ old('id_cliente') }}">
                                @foreach($clientes as $cliente)
                                    @if($cliente->activo == 1)
                                    <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" class="form-control text-uppercase" name="id_type" value="{{ $id_type }}">
                        <input type="hidden" class="form-control text-uppercase" name="deHoy" value=1>
                        <input type="hidden" class="form-control text-uppercase" name="completada" value=0>
                        <input type="hidden" class="form-control text-uppercase" name="monto" value=0>
                        <input type="hidden" class="form-control text-uppercase" name="pago_efec" value=0>
                        <input type="hidden" class="form-control text-uppercase" name="pago_tarj" value=0>
                        <input type="hidden" class="form-control text-uppercase" name="descuento" value=0>

                        <div class="form-group col-md-2" style="padding-left: 0px;">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-success form-control">Agregar</button>
                        </div>
                    </form>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @endif
@endsection