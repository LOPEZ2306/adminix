@extends('layouts.main')

@section('template_title')
    Nuevo Deudor
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Agregar Deudor</div>
            <div class="card-body">
                @include('debtors.form', ['debtor' => new App\Models\Debtor()])
            </div>
        </div>
    </div>
@endsection
