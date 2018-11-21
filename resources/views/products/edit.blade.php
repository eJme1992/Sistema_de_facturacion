@extends('admin')

@section('title', 'Editar {{ $type }}')
@section('content2')

    <h1 class="mt-5form-group col-md-12">Editar {{ $type }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <p>Por favor, corrige los errores debajo:</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" files="true" action="/admin/{{$type}}s/{{$product->id}}" enctype="multipart/form-data">
        {{method_field('PUT')}}
        {{csrf_field()}}
        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Nombre</label>
                <input maxlength="55" type="text" class="text-uppercase form-control" name="nombre" value="{{ old('nombre', $product->nombre) }}" >
            </div>

            <div class="form-group col-md-2">
                <label>Categoria</label>
                <select class="text-uppercase form-control" name="id_categoria" value="{{ old('id_categoria', $product->id_categoria) }}">
                    @foreach($categories as $category)
                        @if($category->id == $product->id_categoria)
                            <option selected value="{{$category->id}}">{{$category->nombre}}</option>
                        @else
                            <option value="{{$category->id}}">{{$category->nombre}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-row">
                <div class="form-group col-md-2">
                    <label>Código de barras</label>
                    <input type="number" min="1" class="text-uppercase form-control" name="codigo" value="{{ old('codigo', $product->codigo) }}" >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-1">
                    <label>Agregar</label>
                    <input type="number" min="0" class="text-uppercase form-control" name="pedido" value="0" >
                </div>
            </div>

            <input type="hidden" class="text-uppercase form-control" name="quedan" value="{{ old('quedan', $product->quedan) }}" >

            <div class="form-row">
                <div class="form-group col-md-1">
                    <label>Costo</label>
                    <input class="text-uppercase form-control" name="costo" value="{{ old('costo', $product->costo) }}" >
                </div>
            </div>

            <div class="form-group col-md-1">
                <label>Monto</label>
                <input class="text-uppercase form-control" name="monto" value="{{ old('monto', $product->monto) }}" >
            </div>

            <div class="form-group col-md-1">
                <label>Imagen</label>
                <label class="btn btn-default btn-file col-md-12">
                    Elegir<input type="file" style="display: none;" name="archivo">
                </label>
            </div>

            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <a href="/admin/{{ $type }}s" class="btn btn-primary form-control">Volver</a>
            </div>

            <div class="form-group col-md-1">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-success form-control">Editar</button>
            </div>

        </div>
    </form>
@endsection