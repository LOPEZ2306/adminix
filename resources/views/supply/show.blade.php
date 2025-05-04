@extends('layouts.main')

@section('template_title')
    Detalle de Abastecimiento
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="card-title">Detalle de Abastecimiento</span>
                            <div class="float-right">
                                <a href="{{ route('supplies.index') }}" class="float-right btn btn-primary btn-sm">Volver</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-4 row">
                            <div class="col-md-6">
                                <h5>Información del Abastecimiento</h5>
                                <p><strong>ID:</strong> {{ $supply->id }}</p>
                                <p><strong>Fecha:</strong> {{ $supply->supply_date->format('d/m/Y H:i') }}</p>
                                <p><strong>Responsable:</strong> {{ $supply->user->name }}</p>
                                <p><strong>Total:</strong> ${{ number_format($supply->total_amount, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h5>Productos Abastecidos</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Marca</th>
                                                <th>Cantidad</th>
                                                <th>Precio Unitario</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($supply->supplyDetails as $detail)
                                                <tr>
                                                    <td>{{ $detail->product->product }}</td>
                                                    <td>{{ $detail->product->brand }}</td>
                                                    <td>{{ $detail->quantity }}</td>
                                                    <td>${{ number_format($detail->product->price, 0, ',', '.') }}</td>
                                                    <td>${{ number_format($detail->quantity * $detail->product->price, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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
