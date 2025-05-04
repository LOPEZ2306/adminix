@extends('layouts.main')

@section('template_title')
    Crear Venta
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <span id="card_title">Crear Venta</span>
                </div>

                <div class="card-body">
                    <form action="{{ route('sales.store') }}" method="POST" id="sale-form">
                        @csrf

                        <div class="mb-3 form-group">
                            <label for="payment_method">Método de Pago</label>
                            <select name="payment_method" class="form-control" required>
                                <option value="Efectivo">Efectivo</option>
                                <option value="Tarjeta de Débito">Tarjeta de Débito</option>
                                <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                                <option value="Transferencia">Transferencia</option>
                            </select>
                        </div>

                        <!-- Productos -->
                        <div id="products-container">
                            <!-- Los productos agregados aparecerán aquí -->
                        </div>

                        <button type="button" class="mb-3 btn btn-success" id="add-product-btn">Agregar Producto</button>
                        <br>

                        <!-- Botones para Enviar o Cancelar -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Enviar Venta</button>
                            <a href="{{ route('sales.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Incluir jQuery para manipulación del DOM -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    let productIndex = 0;

    // Manejar el clic en el botón "Agregar Producto"
    $('#add-product-btn').on('click', function() {
        // Crear un formulario para un nuevo producto
        let productHtml = `
            <div class="mb-3 product-item card" data-index="${productIndex}">
                <div class="card-body">
                    <h6>Producto ${productIndex + 1}</h6>
                    <div class="mb-2 form-group">
                        <label for="products[${productIndex}][product_id]">Producto</label>
                        <select name="products[${productIndex}][product_id]" class="form-control">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-stock="{{ $product->quantity }}">
                                    {{ $product->product }} - {{ $product->brand }} - Precio: ${{ number_format($product->price, 2, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-2 form-group">
                        <label for="products[${productIndex}][quantity]">Cantidad</label>
                        <input type="number" name="products[${productIndex}][quantity]" class="form-control" min="1" required>
                    </div>

                    <div class="mb-2 form-group">
                        <label for="products[${productIndex}][price]">Precio</label>
                        <input type="number" name="products[${productIndex}][price]" class="form-control" value="0" readonly>
                    </div>

                    <div class="mb-2 form-group">
                        <label for="products[${productIndex}][discount]">Descuento</label>
                        <input type="number" name="products[${productIndex}][discount]" class="form-control" value="0">
                    </div>

                    <button type="button" class="btn btn-danger btn-sm remove-product" data-index="${productIndex}">
                        Eliminar Producto
                    </button>
                </div>
            </div>
        `;

        // Agregar el formulario al contenedor
        $('#products-container').append(productHtml);

        // Incrementar el índice para el siguiente producto
        productIndex++;
    });

    // Eliminar producto cuando se hace clic en el botón de eliminar
    $(document).on('click', '.remove-product', function() {
        let index = $(this).data('index');
        $(`.product-item[data-index="${index}"]`).remove();
    });

    // Actualizar el precio cuando el producto es seleccionado
    $(document).on('change', 'select[name^="products"]', function() {
        let productIndex = $(this).closest('.product-item').data('index');
        let price = $(this).find('option:selected').data('price');
        $(`input[name="products[${productIndex}][price]"]`).val(price);
    });

    // Agregar un producto inicialmente para que el formulario no esté vacío
    $('#add-product-btn').trigger('click');
});
</script>
@endsection
