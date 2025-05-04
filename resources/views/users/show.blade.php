@extends('layouts.main')

@section('title', 'Detalles del Usuario')
@section('header', 'Detalles del Usuario')

@section('content')
    <p><strong>Nombre:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Creado el:</strong> {{ $user->created_at }}</p>
    <p><strong>Actualizado el:</strong> {{ $user->updated_at }}</p>
    <a href="{{ route('users.index') }}" class="btn">Volver al listado</a>
@endsection