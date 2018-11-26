@extends('control.index')

@section('content3')
<div style="display: flex;">
    <div>
        <h1 style="margin-top: auto;">{{ $titulo }}</h1>
    </div>
    @if($subtitulo != "La orden todavía no existe")

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


<div class="card card-body">
    <p>
        @if($order->completada != "1")
        <form method="POST" action="/admin/control/ingresos/{{ $tipo }}/{{ $id_order }}">
            {!!csrf_field()!!}
            {{--  Servicios    --}}
            @if($id_type == 2)
            <div class="form-group col-md-3" style="padding-left: 0px;">
                <label>Servicio</label>
                <select class="form-control text-uppercase" name="id_servicio" value="{{ old('id_servicio') }}">
                    @foreach($servicios as $servicio)
                    <option value="{{$servicio->id}}">{{$servicio->nombre}} - ${{$servicio->monto}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-5" style="padding-left: 0px;">
                <label>Detalle</label>
                <input required type="text" maxlength="100" class="form-control text-uppercase" name="detalle" value="{{ old('detalle') }}">
            </div>

            <div class="form-group col-md-2" style="padding-left: 0px;">
                <label>% Descuento</label>
                <input required type="number" class="form-control" name="descuento1" value="0">
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
            {{-- Agregar  --}}
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
            <th scope="col">% Desc.</th>
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
            <td> {{ $orderind->descuento }}<b>%</b></td>
            <td>{{ date('d/m/y', strtotime($orderind->created_at)) }}</td>
            <td>{{ date('H:i', strtotime($orderind->created_at)) }} <b class="text-lowercase" >hs</b></td>
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

    <!-- DD-->
    <div style="display: flex; margin-top:40px">

        <div style="margin-top: 3px; margin-left: 5px;">
            @if($order->descuento == 0)
            @if($order->completada == 0)
{{--
###########################################################
#
#            campos para descuentos finales
#
###########################################################
--}}

<div class="row">
    <div class="col-md-12 ">
        <div class="col-md-12 col-md-offset-12">
            <table class="table col-md-offset-3">
                <tr>
                    <td class="text-right" ><h5>Subtotal: $</h5> </td>
                    <td class="text-left" ><h5>{{ $order->monto }}</h5></td>
                </tr>
                <tr>
                    <td class="text-right" ><h5 class="text-danger" >Descuento: %</h5> </td>
                    <td class="text-left" ><h5 class="text-success" >
                        <form method="POST" action="/admin/control/{{$tipo}}/descuento/{{ $id_order }}">
                            {!!csrf_field()!!}
                            <div class="form-group col-md-4" style="padding-left: 0px;">
                                <input class="btn btn-default" type="number" min="0" max="50" name="descuento" placeholder="Desc %" value="0" style="width: 70px;">
                            </div>

                            <div class="form-group col-md-8" >
                               <button type="submit" class="btn btn-success form-control">Descontar</button>
                           </div>
                       </form>
                   </h5></td>
               </tr>
               <tr>
                <td class="text-right" ><h3>Total: $</h3></td>
                <td class="text-left" ><h3>{{ $order->monto - $order->descuento }}</h3> </td>
            </tr>
        </table>


        @else
        <label class="btn btn-default">Desc % {{ $order->descuento }}</label>
        @endif
        @else

        <div class="col-md-12 col-md-offset-12">
            <div class="col-md-12 col-md-offset-12 ">
                <table class="table col-md-offset-12">
                    <tr>
                        <td class="text-right" ><h5>Subtotal: $</h5> </td>
                        <td class="text-left" ><h5>{{ $order->monto }}</h5></td>
                    </tr>
                    <tr>
                        <td class="text-right" ><h5 class="text-danger" >Descuento: $ </h5> </td>
                        <td class="text-left" ><h5 class="text-success" >{{ $order->descuento }}
                        </h5></td>
                    </tr>
                    <tr>
                        <td class="text-right" ><h3>Total: $</h3></td>
                        <td class="text-left" ><h3>{{ $order->monto - $order->descuento }}</h3> </td>
                    </tr>
                </table>
            </div>
        </div>

        @endif


    </div>

</div>






    {{--< div class="col-md-offset-8">
<label class="text-success"><h4>Subtotal: $ {{ $order->monto }}</h4></label>


<form method="POST" action="/admin/control/{{$tipo}}/descuento/{{ $id_order }}">
            {!!csrf_field()!!}
            <div class="form-group col-md-6" style="padding-left: 0px;">
                <label>% Descuento</label>
                <input class="btn btn-default" type="number" min="0" max="50" name="descuento" placeholder="Desc %" value="0" style="width: 130px;">
            </div>

            <div class="form-group col-md-6" style="padding-left: 0px;">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Descontar</button>
            </div>
        </form>

         @else
        <label class="btn btn-default">Desc ${{ $order->descuento }}</label>
        @endif
        @else
        <label class="btn btn-danger">Desc ${{ $order->descuento }}</label>
        @endif
<label class="text-info"><h4>Total: $ {{ $order->monto - $order->descuento }}</h4></label>
</div> --}}
</div>


{{--
###########################################################
#
#             fin campos para descuentos finales
#
###########################################################
--}}

</div>



</div>
<!-- ACA EMPIEZA EL PROCESADOR DE PAGOS-->
<div class="modal-footer" style="display: flex; margin-top: 0px;">

    <div style="margin-top: 2px; margin-left: auto;" class="row col-md-12">
        @if($order->completada != 1)
        <form method="POST" action="/admin/control/{{$tipo}}/cerrar/{{ $id_order }}">
            <div class="col-md-6" style="display: flex; margin-top: 0px;margin-top: 15px;">
                <h4 style="margin-top: 10px;color: darkviolet; display:" class="mt-2 mb-3">{{ $pie }}</h4>
                <div class="form-group " style="padding-left: 0px;">

                    <select class="form-control text-uppercase" id="id_forma_pago" name="id_forma_pago" value="{{ old('id_forma_pago') }}">
                        @foreach($formasPago as $formaPago)
                        <option value="{{$formaPago->id}}">{{$formaPago->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {!!csrf_field()!!}
            <div class="col-md-6">
             <div class="ocultar" id="op" style="display: inline; margin-bottom:15px; padding-bottom:15px;">
                <input required disabled="" class="btn btn-default " type="number" min="0" name="pago_efec" id="pago_efec" placeholder="Efectivo" style="width: 105px;">
                <input required disabled="" class="btn btn-default" type="number" min="0" name="pago_tarj" id="pago_tarj" placeholder="Tarjeta" style="width: 105px;">
                <input required disabled="" class="btn btn-default" type="number" min="0" name="numero_de_tarjeta" id="numero_de_tarjeta" placeholder="ultimos 4 numeros de la tarjeta" style="width: 105px;">


            </div>

            <input type="hidden" class="form-control" name="completada" value="1">
            <button type="submit" class="btn btn-danger btn-block" style="width: 98px;margin-right: 5px; margin-top:15px;width: 100%;">Terminar</button>
        </div>
    </form>
    @endif
</div>
{{-- -------------------  Cerrar  ------------------ --}}
</div>
@endif




<script type="text/javascript">
    $( document ).ready(function() {
     $("#id_forma_pago").change(function (event) {
       var id = $("#id_forma_pago").find(':selected').val();
       if(id == 3){
        $("#pago_efec").prop('disabled', false);
        $("#pago_tarj").prop('disabled', false);
        $("#numero_de_tarjeta").prop('disabled', false);

        document.getElementById("op").className -= " ocultar";

    }else{
        $("#pago_efec").prop('disabled', true);
        $("#pago_tarj").prop('disabled', true);
        $("#numero_de_tarjeta").prop('disabled', true);
        document.getElementById("op").className += " ocultar";

    }
});
 });

</script>

@endsection