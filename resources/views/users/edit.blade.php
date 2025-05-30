@extends('layouts.main')

@section('title', 'Editar Usuario')
@section('header', 'Editar Usuario')

@section('content')
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nombre:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        @error('name') <div class="error">{{ $message }}</div> @enderror

        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        @error('email') <div class="error">{{ $message }}</div> @enderror

        <label for="password">Contraseña (opcional):</label>
        <input type="password" name="password">
        @error('password') <div class="error">{{ $message }}</div> @enderror

        <label for="role">Rol:</label>
        <select name="role" required>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                    {{ ucfirst($role->name) }}
                </option>
            @endforeach
        </select>
        @error('role') <div class="error">{{ $message }}</div> @enderror

        <br><br>
        <button type="submit">Actualizar</button>
        <a href="{{ route('users.index') }}">Volver</a>
    </form>
@endsection
