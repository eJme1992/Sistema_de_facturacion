@extends('control.index')

@section('content3')

    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>Operación Exitosa!</strong>
            {{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-end">
        @if($titulo == "Sueldos de " . $tipo)
            <h1 class="mt-2 mb-3">{{ $titulo }}</h1>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Historial
            </button>
        @else
            <h2 class="mt-2 mb-3">{{ $titulo }}</h2>
            <a href="{{ url('/admin/control/sueldos/') }}" class="btn btn-primary">Volver</a>
        @endif
    </div>
    <p></p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p>
                <form class="form-inline" method="POST" action="{{ url('/admin/control/sueldos/historial') }}">
                    {!!csrf_field()!!}
                    <div class="form-group">
                        <label> Desde </label>
                        <input required type="date" class="form-control" name="desde">
                    </div>
                    <div class="form-group">
                        <label> Hasta </label>
                        <input required type="date" class="form-control" name="hasta" value="{{ date("Y-m-d") }}">
                    </div>

                    <button type="submit" class="btn btn-success">Buscar</button>
                </form>
            </p>
        </div>
    </div>

    <table class="table">
        <thead class="thead-dark"></thead>
            <tr>
                @if($titulo == "Sueldos de " . $tipo)
                    <th scope="col">Nombre</th>
                    <th scope="col">Sueldo a pagar</th>
                    <th scope="col">Pagos</th>
                @else
                    <th scope="col">Detalle</th>
                    <th scope="col">Monto</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if($titulo == "Sueldos de " . $tipo)
                @foreach ($empleados as $empleado)
                    <tr class="text-uppercase">
                        <td style="vertical-align: middle;">
                            {{ $empleado->nombre }}
                        </td>
                        <td>
                            <form class="form-inline" name="myForm" method="POST" action="{{ url('admin/control/') }}">
                                {!!csrf_field()!!}

                                <input id="Sueldo" style="width: 65px;" required class="form-control sueldo" name="monto" placeholder="$">
                                <input type="hidden" name="admin" value="{{ Auth::user()->nombre }}">
                                <input type="hidden" name="id_desc" value="5">
                                <input type="hidden" name="detalle" value="Pago de sueldo a {{ $empleado->nombre }}">
                                <input type="hidden" name="caja_abierta" value="1">
                                <button type="submit" class="btn btn-primary mb-2">Pagar</button>
                            </form>
                        </td>
                        <td>
                            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample{{ $empleado->id }}" aria-expanded="false" aria-controls="collapseExample">
                                <span class="oi oi-clock"></span>
                            </button>
                        </td>
                    </tr>
                    <tr class="collapse" id="collapseExample{{ $empleado->id }}">
                        <td class="col-xs-10" colspan="7" >
                            <form class="form-inline" method="POST" action="{{ url('/admin/control/sueldos/'. $empleado->nombre) }}">
                                {!!csrf_field()!!}
                                <div class="form-group">
                                    <label>Historial de sueldos para <span class="text-uppercase">{{ $empleado->nombre }}</span> desde</label>
                                    <input type="hidden" name="profesor" value="{{ $empleado->nombre }}">
                                    <input required type="date" class="form-control" name="desde">
                                </div>
                                <div class="form-group">
                                    <label>hasta</label>
                                    <input required type="date" class="form-control" name="hasta" value="{{ date("Y-m-d") }}">
                                </div>

                                <button type="submit" class="btn btn-success">Buscar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                @foreach ($controls as $control)
                <tr>
                    <td>{{ $control->detalle }}</td>
                    <td><b>$ </b>{{ $control->monto }}</td>
                    <td>{{ date('d/m/y', strtotime($control->created_at)) }}</td>
                    <td>{{ date('H:i', strtotime($control->created_at)) }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection