<form method="POST" action="{{ $debtor->exists ? route('debtors.update', $debtor->id) : route('debtors.store') }}">
    @csrf
    @if($debtor->exists)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="full_name" class="form-label">Nombre Completo</label>
        <input type="text" class="form-control" name="full_name" value="{{ old('full_name', $debtor->full_name) }}" required>
    </div>

    <div class="mb-3">
        <label for="cedula" class="form-label">Cédula</label>
        <input type="text" class="form-control" name="cedula" value="{{ old('cedula', $debtor->cedula) }}" required>
    </div>

    <div class="mb-3">
        <label for="residencia" class="form-label">Lugar de Residencia</label>
        <input type="text" class="form-control" name="residencia" value="{{ old('residencia', $debtor->residencia) }}" required>
    </div>

    <div class="mb-3">
        <label for="deuda" class="form-label">Valor de la Deuda</label>
        <input type="number" class="form-control" name="deuda" value="{{ old('deuda', $debtor->deuda) }}" min="0" step="100" required>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
