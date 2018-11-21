@extends('admin')

@section('content2')
    <h1 class="form-group col-md-12">Agregar {{ $userType->nombre }}</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="/admin/{{ $type }}s">
        {!!csrf_field()!!}
        <div class="form-row">
            <div class="form-group col-md-3">
                <label>Nombre</label>
                <input required type="text" class="text-uppercase form-control" name="nombre" value="{{ old('nombre') }}" >
            </div>

            <div class="form-group col-md-2">
                <label>Teléfono</label>
                <input type="number" class="text-uppercase form-control" name="telefono" placeholder="Sin 0 ni 15" value="{{ old('telefono') }}" >
            </div>

            <div class="form-group col-md-3">
                <label>Email</label>
                <input type="email" class="text-uppercase form-control" name="email" value="{{ old('email') }}" >
            </div>

            <div class="form-group col-md-2">
                <label>Dirección</label>
                <input type="text" class="text-uppercase form-control" name="direccion" value="{{ old('direccion') }}" >
            </div>

            <div class="form-group col-md-2">
                <label>Fecha de nac.</label>
                <input type="date" class="text-uppercase form-control" name="nacimiento" value="{{ old('nacimiento') }}" >
            </div>

            @if($userType->nombre == "encargado")
            <div class="form-group col-md-3">
                <label>Password</label>
                <input required type="password" class="text-uppercase form-control" name="password" value="{{ old('password') }}" >
            </div>
            @endif
        </div>

        <div class="form-row">
            <input type="hidden" name="id_uType" value="{{ $userType->id }}" >

            <div class="form-group col-md-3">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Agregar {{$type}}</button>
            </div>

            <div class="form-group col-md-2">
                <label>&nbsp;</label>
                <a href="/admin/{{ $type }}s" class="btn btn-primary form-control">Volver</a>
            </div>
        </div>
    </form>

@endsection