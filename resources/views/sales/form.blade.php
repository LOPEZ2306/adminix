<!-- Formulario de venta -->
<div class="card">
    <div class="card-body">
        <div class="mb-3">
            {{ Form::label('sale_date', 'Fecha') }}
            {{ Form::datetimeLocal('sale_date', $sale->sale_date ?? \Carbon\Carbon::now(), [
                'class' => 'form-control' . ($errors->has('sale_date') ? ' is-invalid' : ''),
                'placeholder' => 'Fecha'
            ]) }}
            {!! $errors->first('sale_date', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="mb-3">
            {{ Form::label('payment_method', 'Método de Pago') }}
            {{ Form::select('payment_method', [
                'Efectivo' => 'Efectivo',
                'Tarjeta de Crédito' => 'Tarjeta de Crédito',
                'Tarjeta de Débito' => 'Tarjeta de Débito',
                'Transferencia' => 'Transferencia'
            ], $sale->payment_method ?? null, [
                'class' => 'form-control' . ($errors->has('payment_method') ? ' is-invalid' : ''),
                'placeholder' => 'Seleccione un método de pago'
            ]) }}
            {!! $errors->first('payment_method', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="mb-3">
            {{ Form::label('total_amount', 'Total') }}
            {{ Form::number('total_amount', $sale->total_amount ?? 0, [
                'class' => 'form-control' . ($errors->has('total_amount') ? ' is-invalid' : ''),
                'placeholder' => 'Total',
                'step' => '0.01',
                'readonly'
            ]) }}
            {!! $errors->first('total_amount', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <div class="mb-4">
            <h5>Productos</h5>
            <div id="products-container">
                <!-- Aquí se cargarán los productos dinámicamente -->
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
            <a href="{{ route('sales.index') }}" class="btn btn-secondary">{{ __('Cancelar') }}</a>
        </div>
    </div>
</div>
