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
                    <span id="card_title">Personas Morosas</span>
                    <a href="{{ route('debtors.create') }}" class="btn btn-danger btn-sm">Agregar Deudor</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="m-4 alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="bg-white card-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Buscar por nombre..." id="searchInput">
                    </div>
                    <div class="row" id="debtorsContainer">
                        @foreach ($debtors as $debtor)
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
                        @endforeach
                    </div>
                    {!! $debtors->withQueryString()->links() !!}
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
                        <input type="number" class="form-control" name="amount" id="payAmount" min="0">
                        <small id="debtWarning" class="text-danger d-none">El monto supera la deuda.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
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
        payAmount.value = '';
        payAmount.oninput = function () {
            warning.classList.toggle('d-none', parseFloat(this.value) <= deuda);
        };
        payModal.show();
    }
</script>
@endsection
