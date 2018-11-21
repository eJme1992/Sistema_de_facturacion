@extends('admin')

@section('content2')

    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>Operación Exitosa!</strong>
            {{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <h1 class="form-group col-md-12">Crear {{ $type }}</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" files="true" action="/admin/{{$type}}s" enctype="multipart/form-data">
        {!!csrf_field()!!}
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Nombre</label>
                <input maxlength="55" type="text" class="text-uppercase form-control" name="nombre" value="{{ old('nombre') }}" >
            </div>
        </div>

        <div class="form-group col-md-2">
            <label>Categoria</label>
            <select class="text-uppercase form-control" name="id_categoria" value="{{ old('id_categoria') }}">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Código barra</label>
                <input type="number" min="1" class="text-uppercase form-control" name="codigo" value="{{ old('codigo') }}" >
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-1">
                <label>Cant.</label>
                <input type="number" min="1" class="text-uppercase form-control" name="pedido" value="{{ old('pedido') }}" >
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-1">
                <label>Costo</label>
                <input class="text-uppercase form-control" name="costo" value="{{ old('costo') }}" >
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-1">
                <label>Monto</label>
                <input class="text-uppercase form-control" name="monto" value="{{ old('monto') }}" >
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-1">
                <label>Imagen</label>
                <label class="btn btn-default btn-file col-md-12">
                Elegir<input type="file" required style="display: none;" name="archivo">
                </label>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <a href="/admin/{{$type}}s" class="btn btn-primary form-control">Volver</a>
            </div>

            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Crear</button>
            </div>
        </div>
    </form>
@endsection