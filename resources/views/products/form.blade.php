<div class="row padding-1 p-1">
    <div class="col-md-12">

        <div class="form-group mb-2">
            <label for="product" class="form-label">Producto</label>
            <input type="text" name="product" class="form-control @error('product') is-invalid @enderror"
                   value="{{ old('product', $product->product ?? '') }}" id="product" placeholder="Producto">
            @error('product')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="brand" class="form-label">Marca</label>
            <input type="text" name="brand" class="form-control @error('brand') is-invalid @enderror"
                   value="{{ old('brand', $product->brand ?? '') }}" id="brand" placeholder="Marca">
            @error('brand')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="quantity" class="form-label">Cantidad</label>
            <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                   value="{{ old('quantity', $product->quantity ?? '') }}" id="quantity" placeholder="Cantidad">
            @error('quantity')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

        <div class="form-group mb-2">
            <label for="price" class="form-label">Precio</label>
            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price', $product->price ?? '') }}" id="price" placeholder="Precio">
            @error('price')
                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
            @enderror
        </div>

    </div>

    <div class="col-md-12 mt-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>
