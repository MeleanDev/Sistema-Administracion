@extends('adminlte.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Ventas')
@section('content_header_title', 'Ventas')
@section('content_header_subtitle', 'Analisis')

{{-- plugins --}}
  {{-- Datatable --}}
    @section('plugins.Datatables', true)
  {{-- Sweetalert2 --}}
    @section('plugins.Sweetalert2', true)
    
{{-- Content body: main page content --}}

@section('content_body')
    <div class="container">
      <div class="informacion Number">
        <div class="row">
          <div class="col-sm text-center">
            <x-adminlte-card title="Recaudacion Total Este Año" theme="success" icon="fas fa-lg fa-comment-dollar">
              <dt>Total : {{ App\Models\MesCantidad::sum('cantidad'); }} Bs.s</dt> 
            </x-adminlte-card>
          </div>
          <div class="col-sm text-center">
            <x-adminlte-card title="Ventas Facturadas este Año" theme="success" icon="fas fa-lg fa-clipboard-check">
              <dt>Total : {{ App\Models\MesCantidad::sum('Compras'); }}</dt> 
            </x-adminlte-card>
          </div>
          <div class="col-sm text-center">
            <x-adminlte-card title="Recaudacion de Ventas Este Mes" theme="success" icon="fas fa-lg fa-search-dollar">
              <dt>Total : {{$datosMes->cantidad}} Bs.s</dt> 
            </x-adminlte-card>
          </div>
        </div>
      </div>
      <div class="informacion grafic">
        <div class="row">
            <div class="col-sm" style="width: 100%">
              <x-adminlte-card body-class="bg-white" title="Recaudacion por mes del Años 2024" theme="info" icon="fas fa-lg fa-chart-line" collapsible >
                <div>
                  <canvas id="Meses"></canvas>
                </div>
              </x-adminlte-card>
            </div>
        </div>
      </div>
      <div class="informacion Productos">
        <div class="row">
          <div class="col-sm text-center">
            <x-adminlte-card title="Productos Vendidos" theme="success" icon="far fa-lg fa-check-square">
              <dt>Total : {{App\Models\ProductoFactura::sum('cantidad')}} Productos Vendidos</dt> 
            </x-adminlte-card>
          </div>
          <div class="col-sm text-center">
            <x-adminlte-card title="Productos en el Almancen" theme="success" icon="fas fa-lg fa-box-open">
              <dt>Total : {{App\Models\Producto::sum('cantidad')}} Productos Disponibles</dt> 
            </x-adminlte-card>
          </div>
        </div>
      </div>
      <div class="informacion tableClienteProducto">
        <div class="row">
          <div class="col-sm text-center">
            <x-adminlte-card title="5 Productos mas vendidos" theme="info" icon="fas fa-lg fa-clipboard-check" collapsible >
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                  <tr>
                </thead>
                <tbody>
                  @foreach ($mejoresProductFac as $item)
                    @if ($item->vendidos >= 1)
                      <tr>
                        <td>{{$item->nombre}}</td>
                        <td>{{$item->vendidos}}</td>
                      </tr>
                    @endif
                  @endforeach
                </tbody>
              </table>
            </x-adminlte-card>
          </div>
          <div class="col-sm text-center">
            <x-adminlte-card title="5 Mejores Ventas Facturadas" theme="info" icon="fas fa-lg fa-comment-dollar" collapsible >
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Factura</th>
                    <th>Cliente</th>
                    <th>Facturado</th>
                    <th>Mes</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($mejoresVentasFac as $item)
                  <tr>
                    <td>{{$item->factura}}</td>
                    <td>{{$item->cedula}}</td>
                    <td>{{$item->totalCompra}}</td>
                    <td>{{ Carbon\Carbon::parse($item->created_at)->format('F') }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </x-adminlte-card>
          </div>
        </div>
      </div>
    </div>
@stop
{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      let cData = JSON.parse('<?= $data; ?>');
      const ctx = document.getElementById('Meses');
      createChart(ctx, cData.data, 'bar', cData.label);

      function createChart(ctx, data, chartType, labels) {
        const colorArray = [
          'rgba(255, 99, 132, 0.8)', // Red
          'rgba(54, 162, 235, 0.8)', // Blue
          'rgba(255, 206, 86, 0.8)', // Yellow
          'rgba(75, 192, 192, 0.8)', // Teal
          'rgba(255, 159, 64, 0.8)', // Orange
          'rgba(153, 102, 255, 0.8)', // Purple
          'rgba(60, 186, 84, 0.8)', // Green
          'rgba(240, 144, 152, 0.8)', // Pink
          'rgba(148, 0, 211, 0.8)', // Purple (darker)
          'rgba(255, 127, 80, 0.8)', // Coral
          'rgba(128, 128, 128, 0.8)', // Gray
          'rgba(255, 193, 7, 0.8)'  // Orange (darker)
        ];

        Chart.defaults.font.size = 12;

        new Chart(ctx, {
            type: chartType,
            data: {
                labels: labels,
                datasets: [{
                    label: '# Dinero Recaudado',
                    data: data,
                    borderWidth: 1,
                    backgroundColor: function(context) {
                        const index = context.dataIndex;
                        return colorArray[index % colorArray.length];
                    }
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }


    </script>
@endpush