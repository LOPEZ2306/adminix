@extends('layouts.main')

@section('title', 'Listado de Usuarios')
@section('header', 'Usuarios Registrados')

@section('content')
    <a href="{{ route('users.create') }}" class="btn">Crear Nuevo Usuario</a>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary">← Regresar al Dashboard</a>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <!-- Eliminamos la columna ID -->
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <!-- Eliminamos la celda ID -->
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-small">Ver</a>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-small">Editar</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-small btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection