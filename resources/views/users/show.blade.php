@extends('admin')

@section('title', 'Ver {{ $type }}')
@section('content2')
    <h1 class="mt-5form-group col-md-12">Ver {{ $type }}</h1>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Nombre</label>
                <input readonly class="text-uppercase form-control" name="nombre" value="{{ $user->nombre }}" >
            </div>

            <div class="form-group col-md-2">
                <label>Teléfono</label>
                <input readonly class="text-uppercase form-control" name="telefono" value="{{ $user->telefono }}" >
            </div>

            <div class="form-group col-md-2">
                <label>Email</label>
                <input readonly class="text-uppercase form-control" name="email" value="{{ $user->email }}" >
            </div>

            <div class="form-group col-md-2">
                <label>Dirección</label>
                <input readonly class="text-uppercase form-control" name="direccion" value="{{ $user->direccion }}" >
            </div>

            <div class="form-group col-md-2">
                <label>Fecha de nac.</label>
                <input readonly class="text-uppercase form-control" name="nacimiento" value="{{ date('d/m/Y', strtotime($user->nacimiento)) }}" >
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label>&nbsp;</label>
                <a href="/admin/{{$type}}s" class="btn btn-primary text-uppercase form-control">Volver</a>
            </div>
        </div>

    </form>
@endsection