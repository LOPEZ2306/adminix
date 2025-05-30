@extends('layouts.main')

@section('title', 'Crear Categoría')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Crear Nueva Categoría</h2>

    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre de la categoría</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control" rows="4"></textarea>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
