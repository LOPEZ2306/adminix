@extends('layouts.main')

@section('template_title')
    Detalle de Abastecimiento #{{ $supply->id }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="card-title">Detalle de Abastecimiento #{{ $supply->id }}</span>
                            <div class="float-right">
                                <button class="mr-2 btn btn-info btn-sm" onclick="window.print()">
                                    <i class="fa fa-print"></i> Imprimir
                                </button>
                                <a href="{{ route('supplies.index') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-arrow-left"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-4 row">
                            <div class="col-md-6">
                                <h5>Información del Abastecimiento</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <th width="150">Número:</th>
                                        <td>#{{ $supply->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha:</th>
                                        <td>{{ $supply->supply_date->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Responsable:</th>
                                        <td>{{ $supply->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td>${{ number_format($supply->total_amount, 0, ',', '.') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h5>Productos Abastecidos</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Producto</th>
                                                <th>Marca</th>
                                                <th>Cantidad</th>
                                                <th>Precio Unitario</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($supply->supplyDetails as $index => $detail)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
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
