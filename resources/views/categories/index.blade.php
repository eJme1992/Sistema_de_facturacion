@extends('admin')

@section('content2')

    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3">Listado de {{ $type }}s</h1>
        <p>
            <a href="{{route('categories.create')}}" class="btn btn-primary">Nueva {{ $type }}</a>
            <a href="{{route('products.index')}}" class="btn btn-info">ir a Productos</a>
        </p>
    </div>

    <table class="table">
        <thead class="thead-dark"></thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr class="text-uppercase">
                    <td>{{ $category->nombre }}</td>
                    <td>
                        <form action="{{ route('categories.delete', $category) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            {{--  <a href="{{ route('categories.show', $category) }}" class="btn btn-success"><span class="oi oi-eye"></span></a>  --}}
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                            {{--  <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span></button>  --}}
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
@endsection