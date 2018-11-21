@extends('control.index')

@section('content3')

    <script language="javascript">
        function fAgrega()
        {
            [].forEach.call(document.querySelectorAll(".porcS"), function(element, index)
            {
                element.addEventListener("input", function()
                {
                    document.querySelectorAll(".sueldo")[index].value = parseInt(this.value) / 100 * parseInt(document.querySelectorAll(".totalS")[index].value) +  parseInt(document.querySelectorAll(".porcP")[index].value) * parseInt(document.querySelectorAll(".totalP")[index].value) / 100;
                },  false);
            });
            [].forEach.call(document.querySelectorAll(".porcP"), function(element, index)
            {
                element.addEventListener("input", function()
                {
                    document.querySelectorAll(".sueldo")[index].value = parseInt(this.value) / 100 * parseInt(document.querySelectorAll(".totalP")[index].value) +  parseInt(document.querySelectorAll(".porcS")[index].value) * parseInt(document.querySelectorAll(".totalS")[index].value) / 100;
                },  false);
            });
        }
    </script>

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
        @if($titulo == "Comisiones de " . $tipo)
            <h1 class="mt-2 mb-3">{{ $titulo }}</h1>
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Historial
            </button>
        @else
            <h2 class="mt-2 mb-3">{{ $titulo }}</h2>
            <a href="{{ url('/admin/control/comisiones/') }}" class="btn btn-primary">Volver</a>
        @endif
    </div>
    <p></p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p>
                <form class="form-inline" method="POST" action="{{ url('/admin/control/comisiones/historial') }}">
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
                @if($titulo == "Comisiones de " . $tipo)
                    <th scope="col">Nombre</th>
                    <th scope="col">$ por Serv</th>
                    <th scope="col">% X Serv</th>
                    <th scope="col">$ por Prod</th>
                    <th scope="col">% X Prod</th>
                    <th scope="col">Comisión</th>
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
            @if($titulo == "Comisiones de " . $tipo)
                @foreach ($empleados as $empleado)
                    <tr class="text-uppercase" >
                        <td style="vertical-align: middle;">
                            {{ $empleado->nombre }}
                        </td>
                        <td>
                            <?php $totalS=0 ?>
                            @foreach ($ordenes_serv as $orden_serv)
                                @if ($orden_serv->id_empleado == $empleado->id)
                                    <?php $totalS = $totalS + $orden_serv->monto - $orden_serv->descuento ?>
                                @endif
                            @endforeach
                            <label class="form-control" style="width: 70px;text-align: center;">{{$totalS}}</label>
                            <input type="hidden" class="totalS" value="{{ $totalS }}">
                        </td>
                        <td>
                            <?php $porcS=10 ?>
                            <input required type="number" min="7" max="30" id="PorcS" class="form-control porcS" style="width: 60px;" placeholder="Porcentaje" value="{{ $porcS }}" onchange="fAgrega();">
                        </td>
                        <td>
                            <?php $totalP=0 ?>
                            @foreach ($ordenes_prod as $orden_prod)
                                @if ($orden_prod->id_empleado == $empleado->id)
                                    <?php $totalP = $totalP + $orden_prod->monto - $orden_prod->descuento ?>
                                @endif
                            @endforeach
                            <label class="form-control" style="width: 70px;text-align: center;">{{$totalP}}</label>
                            <input type="hidden" class="totalP" value="{{ $totalP }}">
                        </td>
                        <td>
                            <?php $porcP=10 ?>
                            <input required type="number" min="7" max="30" id="PorcP" class="form-control porcP" style="width: 60px;" placeholder="Porcentaje" value="{{ $porcP }}" onchange="fAgrega();">
                        </td>
                        <td>
                            <form class="form-inline" name="myForm" method="POST" action="{{ url('admin/control/') }}">
                                {!!csrf_field()!!}

                                <input id="Sueldo" style="width: 65px;" required class="form-control sueldo" name="monto" placeholder="Sueldo" value="{{ ($porcP*$totalP/100)+($porcS*$totalS/100) }}">
                                <input type="hidden" name="admin" value="{{ Auth::user()->nombre }}">
                                <input type="hidden" name="id_desc" value="2">
                                <input type="hidden" name="detalle" value="Pago de comisiones a {{ $empleado->nombre }}">
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
                            <form class="form-inline" method="POST" action="{{ url('/admin/control/comisiones/'. $empleado->nombre) }}">
                                {!!csrf_field()!!}
                                <div class="form-group">
                                    <label>Historial de comisiones para <span class="text-uppercase" >{{ $empleado->nombre }}</span> desde</label>
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