@extends('layouts.main')

@section('title', 'Detalle de Categoría')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Detalle de la Categoría</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><strong>Nombre:</strong> {{ $categoria->nombre }}</h5>
            <p class="card-text"><strong>Descripción:</strong> {{ $categoria->descripcion ?? 'Sin descripción' }}</p>
            <p class="card-text"><strong>Creado el:</strong> {{ $categoria->created_at->format('d/m/Y H:i') }}</p>
            <p class="card-text"><strong>Última actualización:</strong> {{ $categoria->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-warning">Editar</a>
    </div>
</div>
@endsection
