@extends('layouts.main')

@section('template_title')
    Detalles del Deudor
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Información del Deudor</div>
            <div class="card-body">
                <h5><strong>Nombre:</strong> {{ $debtor->full_name }}</h5>
                <p><strong>Cédula:</strong> {{ $debtor->cedula }}</p>
                <p><strong>Dirección:</strong> {{ $debtor->residencia }}</p>
                <p><strong>Deuda:</strong> ${{ number_format($debtor->deuda, 0, ',', '.') }}</p>

                <a href="{{ route('debtors.edit', $debtor->id) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('debtors.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
