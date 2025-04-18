@extends('layouts.main') 

@section('title', 'Mostrar Producto') 

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Mostrar Producto</h3>
                    <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>

                <div class="card-body bg-white">
                    <div class="form-group mb-2">
                        <strong>Producto:</strong>
                        {{ $product->product }}
                    </div>
                    <div class="form-group mb-2">
                        <strong>Marca:</strong>
                        {{ $product->brand }}
                    </div>
                    <div class="form-group mb-2">
                        <strong>Cantidad:</strong>
                        {{ $product->quantity }}
                    </div>
                    <div class="form-group mb-2">
                        <strong>Precio:</strong>
                        {{ number_format($product->price, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
