@extends('admin')

@section('content2')

    <div class="d-flex justify-content-between align-items-end">
        <h1 class="mt-2 mb-3">Listado de {{ $type }}s</h1>
        <p>
            <a href="{{route('services.create')}}" class="btn btn-primary">Nuevo {{ $type }}</a>
        </p>
    </div>

    <table class="table">
        <thead class="thead-dark"></thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Monto</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr class="text-uppercase">
                    <td>{{ $service->nombre }}</td>
                    <td><b>$</b> {{ $service->monto }}</td>
                    <td>
                        <form action="{{ route('services.delete', $service) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            {{--  <a href="{{ route('services.show', $service) }}" class="btn btn-success"><span class="oi oi-eye"></span></a>  --}}
                            <a href="{{ route('services.edit', $service) }}" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                            {{--  <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span></button>  --}}
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
@endsection