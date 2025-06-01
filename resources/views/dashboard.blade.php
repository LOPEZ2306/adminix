@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="mb-2 row">
      <div class="col-sm-6">
        <h1 class="m-0">Panel principal</h1>
      </div>
    </div>
  </div>
</div>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- Cards de resumen -->
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3>150</h3>
            <p>Nuevos pedidos</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
    <div class="small-box bg-primary">
        <div class="inner">
            @if ($topSeller && $topSeller->user)
                <h3>{{ $topSeller->user->name }}</h3>
                <p>Vendedor con más ventas ({{ $topSeller->total_sales }})</p>
            @else
                <h3>Sin datos</h3>
                <p>No hay ventas registradas</p>
            @endif
        </div>
        <div class="icon">
            <i class="fas fa-trophy"></i>
        </div>
        <a href="{{ route('sales.index') }}" class="small-box-footer">
            Más info <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</div>


      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $totalUsuarios }}</h3>
            <p>Usuarios registrados</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{ route('users.index') }}" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $totalDebtors }}</h3>
            <p>Cantidad de personas morosas</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="{{ route('debtors.index') }}" class="small-box-footer">
            Más info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>
    </div>

    <!-- Tarjeta con gráfica (estructura lista) -->
    <div class="row">
      <div class="col-md-6">
        <div class="card" style="max-height: 350px; overflow-y: auto;">
          <div class="card-header">
            <h3 class="card-title">Últimas Ventas</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="p-2 card-body">
            <div class="table-responsive">
              <table class="table mb-0 table-sm table-hover table-bordered">
                <thead class="thead-light">
                  <tr>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Vendedor</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($latestSales as $sale)
                    <tr>
                      <td>{{ $sale->sale_date->format('d/m/Y H:i') }}</td>
                      <td>${{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                      <td>{{ $sale->user->name }}</td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="3" class="text-center">No hay ventas recientes</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card" style="max-height: 350px; overflow-y: auto;">
          <div class="card-header">
            <h3 class="card-title">Productos con bajo stock</h3>
          </div>
          <div class="p-2 card-body">
            <ul class="list-group list-group-flush">
              @forelse ($lowStockProducts as $product)
                <li class="list-group-item {{ $product->quantity <= 1 ? 'text-danger' : '' }}">
                  {{ $product->product }} - {{ $product->brand }}
                  <span class="badge {{ $product->quantity <= 1 ? 'bg-danger' : 'bg-warning' }} float-end">
                    Cantidad: {{ $product->quantity }}
                  </span>
                </li>
              @empty
                <li class="list-group-item">No hay productos con bajo stock</li>
              @endforelse
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Cerrar sesión -->
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="mb-3">Cerrar sesión</button>
    </form>

  </div>
</div>
@endsection
