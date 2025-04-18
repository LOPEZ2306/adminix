@extends('layouts.main')

@section('template_title')
    Editar Producto
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Producto</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('products.update', $product->id) }}" role="form" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf
                            @include('products.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
