@extends('layouts.main')

@section('template_title')
    Detalle de Venta #{{ $sale->id }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="card-title">Detalle de Venta #{{ $sale->id }}</span>
                            <div class="float-right">
                                <button class="mr-2 btn btn-info btn-sm" onclick="window.print()">
                                    <i class="fa fa-print"></i> Imprimir
                                </button>
                                <a href="{{ route('sales.index') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-arrow-left"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-4 row">
                            <div class="col-md-6">
                                <h5>Información de la Venta</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="150">Número de Venta:</th>
                                        <td>#{{ $sale->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha:</th>
                                        <td>{{ $sale->sale_date->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Método de Pago:</th>
                                        <td>{{ $sale->payment_method }}</td>
                                    </tr>
                                    <tr>
                                        <th>Vendedor:</th>
                                        <td>{{ $sale->user->name }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6 text-end">
                                <h3 class="mt-3">Total: ${{ number_format($sale->total_amount, 0, ',', '.') }}</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h5>Detalle de Productos</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Marca</th>
                                                <th>Precio Unitario</th>
                                                <th>Cantidad</th>
                                                <th>Descuento</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $totalItems = 0; @endphp
                                            @foreach ($sale->saleDetails as $index => $detail)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $detail->product->product }}</td>
                                                    <td>{{ $detail->product->brand }}</td>
                                                    <td>${{ number_format($detail->price, 0, ',', '.') }}</td>
                                                    <td>{{ $detail->quantity }}</td>
                                                    <td>${{ number_format($detail->discount, 0, ',', '.') }}</td>
                                                    <td>${{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                                </tr>
                                                @php $totalItems += $detail->quantity; @endphp
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-end">
                                                    <strong>Items totales: {{ $totalItems }}</strong>
                                                </td>
                                                <td colspan="2" class="text-end">
                                                    <strong>Total:</strong>
                                                </td>
                                                <td>
                                                    <strong>${{ number_format($sale->total_amount, 0, ',', '.') }}</strong>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
