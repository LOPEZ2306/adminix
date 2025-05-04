@extends('layouts.main')

@section('template_title')
    Historial de Abastecimiento
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span id="card_title">Historial de Abastecimiento</span>
                    <a href="{{ route('supplies.create') }}" class="btn btn-primary btn-sm">Nuevo abastecimiento</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="m-4 alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="bg-white card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Productos</th>
                                    <th>Responsable</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplies as $supply)
                                    <tr>
                                        <td>{{ $loop->iteration + ($supplies->currentPage() - 1) * $supplies->perPage() }}</td>
                                        <td>{{ $supply->supply_date->format('d/m/Y H:i') }}</td>
                                        <td>${{ number_format($supply->total_amount, 0, ',', '.') }}</td>
                                        <td>{{ $supply->supplyDetails->count() }}</td>
                                        <td>{{ $supply->user->name }}</td>
                                        <td>
                                            <form action="{{ route('supplies.destroy', $supply->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary" href="{{ route('supplies.show', $supply->id) }}">
                                                    <i class="fa fa-fw fa-eye"></i> Ver
                                                </a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('¿Estás seguro de eliminar este abastecimiento?')">
                                                    <i class="fa fa-fw fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $supplies->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
