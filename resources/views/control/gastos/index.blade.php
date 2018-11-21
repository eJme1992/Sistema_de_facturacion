@extends('control.index')

@section('content3')

    <div class="d-flex justify-content-between align-items-end">

        @if($titulo == "Gastos de " . $nombre . " del día")
            <h1 class="mt-2 mb-3">{{ $titulo }}</h1>
        @else
            <h2 class="mt-2 mb-3">{{ $titulo }}</h2>
        @endif

        <p>
            <form class="form-inline" method="POST" action="{{ url('admin/control/') }}">
                {!!csrf_field()!!}

                @if($titulo == "Gastos de " . $nombre . " del día")
                <div class="form-group mx-sm-3 mb-2">
                    <input type="hidden" class="form-control" name="admin" value="{{ Auth::user()->nombre }}">
                    <input type="number" required class="form-control" name="monto" placeholder="Cargar gasto">
                    <input type="hidden" class="form-control" name="id_desc" value="{{ $id_desc }}">
                    <input type="text" class="form-control" name="detalle" placeholder="Cargar detalle del gasto" value="Gastos de {{$nombre}}">
                    <input type="hidden" class="form-control" name="caja_abierta" value="1">
                </div>

                <button type="submit" class="btn btn-primary mb-2">Cargar</button>
                @else
                <a href="{{ url('/admin/control/gastos/' . $nombre) }}" class="btn btn-primary">Volver</a>
                @endif
                <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Historial
                </button>
            </form>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <p>
                        <form class="form-inline" method="POST" action="{{ url('/admin/control/gastos/' . $nombre) }}">
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
        </p>
    </div>

    <table class="table">
        <thead class="thead-dark"></thead>
            <tr></tr>
                <th scope="col">#</th>
                <th scope="col">Usuario</th>
                <th scope="col">Detalle</th>
                <th scope="col">Monto</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                @if($titulo == "Gastos de " . $nombre . " del día")
                    <th scope="col">Borrar</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($controls as $control)
                <tr class="text-uppercase" >
                    <th scope="row">{{ $control->id }}</th>
                    <td>{{ $control->admin }}</td>
                    <td>{{ $control->detalle }}</td>
                    <td><b>$</b> {{ $control->monto }}</td>
                    <td>{{ date('d/m/y', strtotime($control->created_at)) }}</td>
                    <td>{{ date('H:i', strtotime($control->created_at)) }} <b>hs</b></td>
                    @if($titulo == "Gastos de " . $nombre . " del día")
                        <td>
                            <form action="{{ route('control.delete', [$id = $control->id]) }}" method="POST">
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
@endsection