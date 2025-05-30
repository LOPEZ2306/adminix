@extends('layouts.main')

@section('template_title')
    Editar Deudor
@endsection

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Editar Deudor</div>
            <div class="card-body">
                @include('debtors.form', ['debtor' => $debtor])
            </div>
        </div>
    </div>
@endsection
