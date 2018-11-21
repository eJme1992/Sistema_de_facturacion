@extends('admin')
@section('content2')

    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3">Listado de {{ $type }}s</h1>
        <p>
            <a href="{{route('products.create')}}" class="btn btn-primary">Nuevo {{ $type }}</a>
            <a href="{{route('categories.index')}}" class="btn btn-info">ir a Categorias</a>
            <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <span class="oi oi-list"></span> <b>Filtrar</b>
            </button>
        </p>
    </div>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <p>
                <form class="form-inline" method="POST" action="/admin/productos/filtro">

                    {!!csrf_field()!!}

                    <div class="form-group">
                        <select class="text-uppercase form-control" name="id_categoria" value="{{ old('id_categoria') }}">
                            @foreach($categories as $category)
                                <option   value="{{$category->id}}">{{$category->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success"><span class="oi oi-check"></span></button>
                    <a href="{{ route('products.index') }}" class="btn btn-danger"><span class="oi oi-x"></span><b> Borrar filtro</b></a>

                </form>
            </p>
        </div>
    </div>

    <table class="table">
        <thead class="thead-dark"></thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Categoría</th>
                <th scope="col">Código barra</th>
                <th scope="col">Pedido</th>
                <th scope="col">Quedan</th>
                <th scope="col">Costo</th>
                <th scope="col">Monto</th>
                <th scope="col">Foto</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="text-uppercase" >
                    <td>{{ $product->nombre }}</td>
                    <td>
                        @foreach ($categories as $category)
                        @if($product->id_categoria == $category->id)
                        {{ $category->nombre }}
                        @endif
                        @endforeach
                    </td>
                    <td>
                        <?php
                        echo DNS1D::getBarcodeHTML("$product->codigo", "EAN13", 1, 35);
                        ?>
                    </td>
                    <td>{{ $product->pedido }} <b class="text-lowercase">uds.</b></td>
                    <td>{{ $product->quedan }} <b class="text-lowercase">uds.</b></td>
                    <td><b>$</b> {{ $product->costo }}</td>
                    <td><b>$</b> {{ $product->monto }}</td>
                    <td>
                        <img class="zoom" width="36px" src="../../uploads/{{$product->archivo}}">
                    </td>
                    <td>
                        <form action="{{ route('products.delete', $product) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            {{--  <a href="{{ route('products.show', $product) }}" class="btn btn-success"><span class="oi oi-eye"></span></a>  --}}
                            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                            {{--  <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span></button>  --}}
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
@endsection