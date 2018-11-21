@extends('admin')

@section('title', 'Ver Profesor')
@section('content2')
    <h1 class="mt-5form-group col-md-12">Ver Profesor</h1>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Nombre</label>
                <input readonly class="text-uppercase form-control" name="nombre" value="{{ $trainer->nombre }}" >
            </div>

            <div class="form-group col-md-2">
                <label>Teléfono</label>
                <input readonly class="text-uppercase form-control" name="telefono" value="{{ $trainer->telefono }}" >
            </div>

            <div class="form-group col-md-2">
                <label>Email</label>
                <input readonly class="text-uppercase form-control" name="email" value="{{ $trainer->email }}" >
            </div>

            <div class="form-group col-md-2">
                <label>Dirección</label>
                <input readonly class="text-uppercase form-control" name="direccion" value="{{ $trainer->direccion }}" >
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-2">
                <label>Fecha de nac.</label>
                <input readonly class="text-uppercase form-control" name="nacimiento" value="{{ date('d/m/Y', strtotime($trainer->nacimiento)) }}" >
            </div>

            <div class="form-group col-md-2">
                <label>Inicio</label>
                <input readonly class="text-uppercase form-control" name="inicio" value="{{ date('d/m/Y', strtotime($trainer->inicio)) }}" >
            </div>

            <div class="form-group col-md-3">
                <label>&nbsp;</label>
                <a href="/admin/profesores" class="btn btn-primary form-control">Volver al listado de profesores</a>
            </div>

        </div>
    </form>
@endsection