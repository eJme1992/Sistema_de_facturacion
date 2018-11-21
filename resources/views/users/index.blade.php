@extends('admin')

@section('content2')

    <div class="d-flex justify-content-between align-items-end">
        @if($activos == true)
        <h1 class="mt-2 mb-3">Listado de {{ $type }}s</h1>
        @else
        <h1 class="mt-2 mb-3">Listado de {{ $type }}s borrados</h1>
        @endif
        <p>
            @if($activos == true)
            <a href="/admin/{{$type}}s/nuevo" class="btn btn-primary">Nuevo {{ $type }}</a>
            <a href="/admin/{{$type}}s/papelera" class="btn btn-danger"><span class="oi oi-trash"></span> Papelera</a>
            @else
            <a href="/admin/{{$type}}s" class="btn btn-primary">Volver</a>
            @endif
        </p>
    </div>

    <table class="table">

        <thead class="thead-dark"></thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Teléfono</th>
                <th scope="col">E-Mail</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                @if($activos == false)
                <tr style="background-color: #ff8e8e;">
                @else
                <tr class="text-uppercase" >
                @endif
                    <td>{{ $user->nombre }}</td>
                    <td>{{ $user->telefono }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->activo == 1)
                            <form action="{{ route('users.delete', [$type, $user]) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <a href="{{ route('users.show', [$type, $nombre = $user->nombre]) }}" class="btn btn-success"><span class="oi oi-eye"></span></a>
                            <a href="{{ route('users.edit', [$type, $nombre = $user->nombre]) }}" class="btn btn-warning"><span class="oi oi-pencil"></span></a>
                            <button class="btn btn-danger" type="submit"><span class="oi oi-trash"></span></button>
                            @if($user->id_uType == 3)
                            <a href="{{ route('users.record', [$nombre = $user->nombre]) }}" class="btn btn-info"><span class="oi oi-clock"></span></a>
                            @endif
                            </form>
                        @else
                        <form action="{{ route('users.resurrect', [$type, $user]) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" type="submit"><span class="oi oi-action-undo"></span> Recuperar</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>
@endsection