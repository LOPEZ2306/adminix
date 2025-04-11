@extends('layouts.app')

@section('template_title')
    {{ $product->product ?? 'Mostrar Producto' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">Mostrar Producto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}">
                                Volver
                            </a>
                        </div>
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
                            {{ $product->price }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
