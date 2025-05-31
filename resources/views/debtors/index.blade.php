@extends('layouts.main')

@section('template_title')
    Deudores
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span id="card_title">Personas Morosas ({{ $totalDebtors }} total)</span>
                    <a href="{{ route('debtors.create') }}" class="btn btn-danger btn-sm">Agregar Deudor</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="m-4 alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="m-4 alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="bg-white card-body">
                    <!-- Formulario de búsqueda -->
                    <form method="GET" action="{{ route('debtors.index') }}" class="mb-3">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       placeholder="Buscar por nombre..."
                                       value="{{ $search ?? '' }}"
                                       id="searchInput">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fas fa-search"></i> Buscar
                                </button>
                                @if($search)
                                    <a href="{{ route('debtors.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Limpiar
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>

                    <!-- Mostrar información de búsqueda -->
                    @if($search)
                        <div class="alert alert-info">
                            <strong>Búsqueda:</strong> "{{ $search }}"
                            - {{ $filteredCount }} resultado(s) encontrado(s)
                        </div>
                    @endif

                    <div class="row" id="debtorsContainer">
                        @forelse ($debtors as $debtor)
                            <div class="mb-4 col-md-6">
                                <div class="shadow-sm card border-danger">
                                    <div class="card-body">
                                        <h5 class="card-title text-danger">{{ $debtor->full_name }}</h5>
                                        <p class="mb-1 card-text">
                                            <strong>Cédula:</strong> {{ $debtor->cedula }}<br>
                                            <strong>Dirección:</strong> {{ $debtor->residencia }}<br>
                                            <strong>Debe:</strong> ${{ number_format($debtor->deuda, 0, ',', '.') }}
                                        </p>
                                        <a class="btn btn-sm btn-primary" href="{{ route('debtors.show', $debtor->id) }}">
                                            <i class="fa fa-fw fa-eye"></i> Ver detalles
                                        </a>
                                        <a class="btn btn-sm btn-success" href="{{ route('debtors.edit', $debtor->id) }}">
                                            <i class="fa fa-fw fa-edit"></i> Editar
                                        </a>
                                        <button class="mt-2 btn btn-success btn-sm" onclick="openPayModal({{ $debtor->id }}, {{ $debtor->deuda }})">Pagar</button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center alert alert-warning">
                                    @if($search)
                                        No se encontraron deudores que coincidan con "{{ $search }}"
                                    @else
                                        No hay deudores registrados
                                    @endif
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Paginación -->
                    @if($debtors->hasPages())
                        <div class="d-flex justify-content-center">
                            {!! $debtors->withQueryString()->links() !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para pagar deuda -->
<div class="modal fade" id="payModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="payForm" method="POST" action="{{ route('debtors.pay') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="debtor_id" id="debtorId">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Monto a pagar</label>
                        <input type="number" class="form-control" name="amount" id="payAmount" min="0" step="0.01">
                        <small id="debtWarning" class="text-danger d-none">El monto supera la deuda.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="submitPayBtn">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openPayModal(id, deuda) {
        document.getElementById('debtorId').value = id;
        const payModal = new bootstrap.Modal(document.getElementById('payModal'));
        const payAmount = document.getElementById('payAmount');
        const warning = document.getElementById('debtWarning');
        const submitBtn = document.getElementById('submitPayBtn');

        payAmount.value = '';

        payAmount.oninput = function () {
            const isOverLimit = parseFloat(this.value) > deuda;
            warning.classList.toggle('d-none', !isOverLimit);
            submitBtn.disabled = isOverLimit;
        };

        payModal.show();
    }
</script>
@endsection
