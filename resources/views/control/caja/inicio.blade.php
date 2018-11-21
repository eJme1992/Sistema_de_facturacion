@extends('control.index')

@section('content3')

    <div class="d-flex justify-content-between align-items-end">

            @if($caja_abierta)
                <h1 style="color: #009000;">{{ $titulo }}
                    <img src="..\..\..\Circle-unlock.png" width="36px" height="36px" style="margin-bottom: 5px;">
                </h1>
            @else
                <h1 style="color: #900000;">{{ $titulo }}
                    <img src="..\..\..\Circle-lock.png" width="36px" height="36px" style="margin-bottom: 5px;">
                </h1>
            @endif
        <p>
            <form class="form-inline" method="POST" action="{{ url('admin/control/') }}">
                {!!csrf_field()!!}
                <div class="form-group mx-sm-3 mb-2">
                    <input type="hidden" class="form-control" name="admin" value="{{ Auth::user()->nombre }}">
                    <input
                    @if($caja_abierta)
                    disabled
                    @endif
                    type="number" min="0" required class="form-control" name="monto" placeholder="Ingrese un monto">
                    <input type="hidden" class="form-control" name="id_desc" value="1">
                    <input type="hidden" class="form-control" name="detalle" value="Caja Inicial">
                    <input type="hidden" class="form-control" name="caja_abierta" value="1">
                </div>
                @if($caja_abierta)
                    <button disabled type="submit" class="btn btn-success mb-2">( Abierta )</button>
                    {{-- Button trigger modal --}}
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">Cerrar</button>
                @else
                    <button disabled type="button" class="btn btn-danger">( Cerrada )</button>
                    <button type="submit" class="btn btn-success mb-2">Abrir</button>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" style="padding-top: 150px;" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmar operación</h5>
                            </div>
                            <div class="modal-body">
                                ¿Deseas cerrar la caja?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <a href="{{route('control.caja.cierre')}}" class="btn btn-danger">Sí, cerrar</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </p>
    </div>

    <table class="table">
        <thead class="thead-dark"></thead>
          <tr></tr>
            <th scope="col">#</th>
            <th scope="col">Usuario</th>
            <th scope="col">Monto</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Borrar</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($controls as $control)
            <tr class="text-uppercase" >
                <th scope="row">{{ $control->id }}</th>
                <td>{{ $control->admin }}</td>
                <td><b>$</b> {{ $control->monto }}</td>
                <td>{{ $control->created_at->format('d/m/Y') }}</td>
                <td>{{ $control->created_at->format('H:i') }} <b class="text-lowercase">hs</b></td>
                <td>
                    <form action="{{ route('control.delete', [$id = $control->id]) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger" type="submit">
                            <span class="oi oi-trash"></span>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
@endsection