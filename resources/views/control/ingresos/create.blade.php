@extends('control.index')

@section('content3')

    <div style="display: flex;">
        <div>
            <h1 style="margin-top: auto;">{{ $titulo }}</h1>
        </div>
        @if($subtitulo != "La orden todavía no existe")
            <div style="margin-left: auto; margin-top: 3px;">
                <label class="btn btn-success">TOTAL ${{ $order->monto }}</label>
            </div>
            <div style="margin-top: 3px; margin-left: 5px;">
                @if($order->descuento == 0)
                    @if($order->completada == 0)
                    <form method="POST" action="/admin/control/{{$tipo}}/descuento/{{ $id_order }}">
                        {!!csrf_field()!!}
                        <input class="btn btn-default" type="number" min="0" max="25" name="descuento" placeholder="DESC %" style="width: 105px;">
                    </form>
                    @else
                        <label class="btn btn-default">DESC ${{ $order->descuento }}</label>
                    @endif
                @else
                    <label class="btn btn-danger">DESC ${{ $order->descuento }}</label>
                @endif
            </div>
            <div style="margin-top: 3px; margin-left: 5px;">
                <label class="btn btn-warning">MONTO ${{ $order->monto - $order->descuento }}</label>
            </div>
            <div style="margin-top: 3px; margin-left: 5px;">
                @if($order->completada == 1)
                    @if(str_contains(URL::previous(), 'clientes'))
                    <a href="{{ URL::previous() }}" class="btn btn-primary"><span class="oi oi-arrow-left"></span> <b>VOLVER</b></a>
                    @else
                    <a href="/admin/control/ingresos/{{$tipo}}" class="btn btn-primary"><span class="oi oi-arrow-left"></span> <b>VOLVER</b></a>
                    @endif
                @endif
            </div>
        @endif
    </div>

    <p>
        <h4 class="mt-2 mb-3">{{ $subtitulo }}</h4>
    </p>

    @if($subtitulo != "La orden todavía no existe")
        <div style="display: flex; margin-top: 0px;">
            <h4 style="margin-top: 10px;color: darkviolet;" class="mt-2 mb-3">{{ $pie }}</h4>
            <div style="margin-top: 2px; margin-left: auto;">
                @if($order->completada != 1)
                    <form method="POST" action="/admin/control/{{$tipo}}/cerrar/{{ $id_order }}">
                    {!!csrf_field()!!}
                        @if($order->id_forma_pago == 3)
                        <input required class="btn btn-default" type="number" min="0" name="pago_efec" placeholder="Efectivo" style="width: 105px;">
                        <input required class="btn btn-default" type="number" min="0" name="pago_tarj" placeholder="Tarjeta" style="width: 105px;">
                        @endif
                        <input type="hidden" class="form-control" name="completada" value="1">
                        <button type="submit" class="btn btn-danger" style="width: 98px;margin-right: 5px;">Terminar</button>
                    </form>
                @endif
            </div>
            {{-- -------------------  Cerrar  ------------------ --}}
        </div>

        <div class="card card-body">
            <p>
                @if($order->completada != "1")
                    <form method="POST" action="/admin/control/ingresos/{{ $tipo }}/{{ $id_order }}">
                        {!!csrf_field()!!}
                        {{-- -------------------  Servicios  --------------------}}
                        @if($id_type == 2)
                            <div class="form-group col-md-3" style="padding-left: 0px;">
                                <label>Servicio</label>
                                <select class="form-control text-uppercase" name="id_servicio" value="{{ old('id_servicio') }}">
                                    @foreach($servicios as $servicio)
                                        <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6" style="padding-left: 0px;">
                                <label>Detalle</label>
                                <input required type="text" maxlength="100" class="form-control text-uppercase" name="detalle" value="{{ old('detalle') }}">
                            </div>
                            {{--   Productos   --}}
                        @else
                            <div class="form-group col-md-5" style="padding-left: 0px;">
                                <label>Producto</label>
                                <select class="form-control text-uppercase " name="id_producto" value="{{ old('id_producto') }}">
                                    @foreach($productos as $producto)
                                        <option value="{{$producto->id}}">{{$producto->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-2" style="padding-left: 0px;">
                                <label>Cant</label>
                                <input required type="number" min="0" class="form-control" name="cantidad" value="{{ old('cantidad') }}">
                            </div>
                        @endif
                        <input type="hidden" class="form-control" name="id_type" value="{{ $id_type }}">
                        <input type="hidden" class="form-control" name="id_order" value="{{ $id_order }}">
                        {{---------------------  Agregar  --------------------}}
                        <div class="form-group col-md-2" style="padding-left: 0px;">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-success form-control">Agregar</button>
                        </div>
                    </form>
                @endif
            </p>
        </div>

        <p></p>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    @if($id_type == 2)
                        <th scope="col">Servicio</th>
                        <th scope="col">Detalle</th>
                    @else
                        <th scope="col">Producto</th>
                        <th scope="col">Cant.</th>
                    @endif
                    <th scope="col">Monto</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    @if($order->completada != 1)
                    <th scope="col">Borrar</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($orders_indiv as $orderind)
                    <tr class="text-uppercase" >
                        @if($id_type == 2)
                            <td scope="row">
                                @foreach($servicios as $servicio)
                                    @if($servicio->id == $orderind->id_servicio)
                                        {{$servicio->nombre}}
                                        @break
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $orderind->detalle }}</td>
                        @else
                            <td scope="row">
                                @foreach($productos as $producto)
                                    @if($producto->id == $orderind->id_producto)
                                        {{$producto->nombre}}
                                        @break
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $orderind->cantidad }}</td>
                        @endif
                        <td><b>$</b> {{ $orderind->monto }}</td>
                        <td>{{ date('d/m/y', strtotime($orderind->created_at)) }}</td>
                        <td>{{ date('H:i', strtotime($orderind->created_at)) }} <b>hs</b></td>
                        @if($order->completada != 1)
                            <td>
                                {{-- <form action="{{ route('control.delete', [$id = $orderind->id]) }}" method="POST"> --}}
                                <form method="POST" action="/admin/control/ingresos/{{ $tipo }}/{{ $id = $orderind->id }}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger" type="submit">
                                        <span class="oi oi-trash"></span>
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection