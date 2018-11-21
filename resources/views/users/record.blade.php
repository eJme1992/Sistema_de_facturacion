@extends('admin')

@section('content2')

    <div class="d-flex justify-content-between align-items-end">

        @if($titulo == "Historial para " . $nombre .  " (Últimos 6 meses)")
            <h1 class="mt-2 mb-3">{{ $titulo }}</h1>
        @else
            <h2 class="mt-2 mb-3">{{ $titulo }}</h2>
        @endif
        <a href="/admin/clientes" class="btn btn-primary col-md-1">Volver</a>
        <button style="margin-left: 4px;" class="btn btn-info" data-toggle="collapse" data-target="#collapseExample2">
            Búsqueda
        </button>
        <div class="collapse indent" id="collapseExample2">
            <div class="card card-body">
                <p>
                    <form class="form-inline" method="POST" action="{{ url('/admin/clientes/'.$nombre.'/historial') }}">
                        {!!csrf_field()!!}
                        <div class="form-group">
                            <label> Desde </label>
                            <input required type="date" class="text-uppercase form-control" name="desde" value="{{ date("Y-m-d") }}">
                        </div>
                        <div class="form-group">
                            <label> Hasta </label>
                            <input required type="date" class="text-uppercase form-control" name="hasta" value="{{ date("Y-m-d") }}">
                        </div>

                        <button type="submit" class="btn btn-success">Buscar</button>

                    </form>
                </p>
            </div>
        </div>
    </div>

    <p></p>

    <table class="table">
        <thead class="thead-dark"></thead>
            <tr>
                <th scope="col">Atendió</th>
                <th scope="col">Orden</th>
                <th scope="col">Tipo</th>
                <th scope="col">Pago con</th>
                <th scope="col">Monto</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Ver</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr class="text-uppercase" >
                    <td>
                        @foreach($empleados as $empleado)
                            @if($empleado->id == $order->id_empleado)
                                {{$empleado->nombre}}
                                @break
                            @endif
                        @endforeach
                    </td>
                    <td>#{{ $order->id }}</td>
                    <td>
                        @foreach($orderTypes as $tipoOrden)
                            @if($tipoOrden->id == $order->id_type)
                                {{$tipoOrden->nombre}}
                                @break
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($formasPago as $formaPago)
                            @if($formaPago->id == $order->id_forma_pago)
                                {{$formaPago->nombre}}
                                @break
                            @endif
                        @endforeach
                    </td>
                    <td><b>$</b> {{ $order->monto - $order->descuento }}</td>
                    <td>{{ date('d/m/y', strtotime($order->created_at)) }}</td>
                    <td>{{ date('H:i', strtotime($order->created_at)) }} <b>hs</b></td>
                    <td><a href="/admin/control/ingresos/{{$tipoOrden->nombre}}/{{ $order->id }}" class="btn btn-success"><span class="oi oi-eye"></span></a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection