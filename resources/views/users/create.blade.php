@extends('layouts.main')

@section('title', 'Crear Usuario')
@section('header', 'Crear Nuevo Usuario')

@section('content')
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror
        <br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror
        <br>

        <button type="submit" class="btn">Guardar</button>
        <a href="{{ route('users.index') }}" class="btn">Volver al listado</a>
    </form>
@endsection