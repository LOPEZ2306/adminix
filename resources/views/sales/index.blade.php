@extends('layouts.main')

@section('template_title')
    Historial de Ventas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span id="card_title">Historial de Ventas</span>
                        <a href="{{ route('sales.create') }}" class="btn btn-primary btn-sm">Nueva Venta</a>
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
                                        <th>Método de Pago</th>
                                        <th>Total</th>
                                        <th>Productos</th>
                                        <th>Vendedor</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale)
                                        <tr>
                                            <td>{{ $loop->iteration + ($sales->currentPage() - 1) * $sales->perPage() }}</td>
                                            <td>{{ $sale->sale_date->format('d/m/Y H:i') }}</td>
                                            <td>{{ $sale->payment_method }}</td>
                                            <td>${{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                                            <td>{{ $sale->saleDetails->count() }}</td>
                                            <td>{{ $sale->user->name }}</td>
                                            <td>
                                                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('sales.show', $sale->id) }}">
                                                        <i class="fa fa-fw fa-eye"></i> Ver
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('¿Estás seguro de eliminar esta venta?')">
                                                        <i class="fa fa-fw fa-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $sales->withQueryString()->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
