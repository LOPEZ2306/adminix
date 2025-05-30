@extends('layouts.main')

@section('template_title')
    Nuevo Abastecimiento
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span class="card-title">Nuevo Abastecimiento</span>
                            <div class="float-right">
                                <a href="{{ route('supplies.index') }}" class="float-right btn btn-primary btn-sm">Volver</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('supplies.store') }}" role="form" id="supplyForm">
                            @csrf

                            <div id="products-container">
                                <div class="mb-3 row product-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_id">Producto</label>
                                            <select name="products[0][product_id]" class="form-control product-select" required>
                                                <option value="">Seleccionar producto</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                                        {{ $product->product }} - {{ $product->brand }} (${{ number_format($product->price, 0, ',', '.') }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="quantity">Cantidad</label>
                                            <input type="number" name="products[0][quantity]" class="form-control product-quantity" value="1" min="1" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="button" class="mb-3 btn btn-danger remove-product" style="display: none;">Eliminar</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <div class="col-md-12">
                                    <button type="button" id="add-product" class="btn btn-success">Agregar otro producto</button>
                                </div>
                            </div>

                            <div class="mt-3 row">
                                <div class="text-right col-md-12">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('.product-select').select2();

        let productIndex = 0;

        // Agregar un nuevo producto
        document.getElementById('add-product').addEventListener('click', function() {
            productIndex++;

            const productRow = document.createElement('div');
            productRow.className = 'row product-row mb-3';
            productRow.innerHTML = `
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_id">Producto</label>
                        <select name="products[${productIndex}][product_id]" class="form-control product-select" required>
                            <option value="">Seleccionar producto</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                    {{ $product->product }} - {{ $product->brand }} (${{ number_format($product->price, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="quantity">Cantidad</label>
                        <input type="number" name="products[${productIndex}][quantity]" class="form-control product-quantity" value="1" min="1" required>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="mb-3 btn btn-danger remove-product">Eliminar</button>
                </div>
            `;

            document.getElementById('products-container').appendChild(productRow);

            $(productRow).find('.product-select').select2();

            if (document.querySelectorAll('.product-row').length > 1) {
                document.querySelector('.product-row .remove-product').style.display = 'block';
            }

            productRow.querySelector('.product-select').addEventListener('change', calculateTotal);
            productRow.querySelector('.product-quantity').addEventListener('input', calculateTotal);

            productRow.querySelector('.remove-product').addEventListener('click', function() {
                productRow.remove();
                calculateTotal();

                if (document.querySelectorAll('.product-row').length === 1) {
                    document.querySelector('.product-row .remove-product').style.display = 'none';
                }
            });
        });

        document.querySelectorAll('.product-select').forEach(select => {
            select.addEventListener('change', calculateTotal);
        });

        document.querySelectorAll('.product-quantity').forEach(input => {
            input.addEventListener('input', calculateTotal);
        });

        document.getElementById('supplyForm').addEventListener('submit', function(e) {
            const productSelects = document.querySelectorAll('.product-select');
            const productIds = new Set();
            let hasDuplicates = false;

            productSelects.forEach(select => {
                const productId = select.value;
                if (productId && productIds.has(productId)) {
                    hasDuplicates = true;
                }
                productIds.add(productId);
            });

            if (hasDuplicates) {
                e.preventDefault();
                alert('Hay productos duplicados. Por favor, seleccione productos diferentes o ajuste las cantidades.');
            }
        });
    });
</script>
@endpush
