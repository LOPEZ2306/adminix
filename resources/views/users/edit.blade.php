@extends('layouts.main')

@section('title', 'Editar Usuario')
@section('header', 'Editar Usuario')

@section('content')
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <div>
            <label for="password">Contraseña (opcional):</label>
            <input type="password" name="password" id="password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <button type="submit" class="btn">Actualizar</button>
        <a href="{{ route('users.index') }}" class="btn">Volver al listado</a>
    </form>
@endsection