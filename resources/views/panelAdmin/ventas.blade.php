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
            <x-adminlte-card title="Total Cantidad de Ventas Este Año" theme="success" icon="fas fa-lg fa-clipboard-check">
              <dt>Total : </dt> 
            </x-adminlte-card>
          </div>
          <div class="col-sm text-center">
            <x-adminlte-card title="Recaudacion de Ventas Este Mes" theme="success" icon="fas fa-lg fa-search-dollar">
              <dt>Total : {{$datosMes->cantidad}}Bs.s</dt> 
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
            <div class="col-sm" style="width: 100%">
              <x-adminlte-card body-class="bg-white" title="Recaudacion en distinto medios de pago 2024" theme="info" icon="fas fa-lg fa-chart-pie" collapsible >
                <div>
                  <canvas id="Cuentas"></canvas>
                </div>
              </x-adminlte-card>
            </div>
        </div>
      </div>
      <div class="informacion tableClienteProducto">
        <div class="row">
          <div class="col-sm text-center">
            <x-adminlte-card title="5 Productos Mas Vendidos" theme="info" icon="fas fa-lg fa-comment-dollar" collapsible >
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                  </tr>
                  <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                  </tr>
                  <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                  </tr>
                  <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                  </tr>
                  <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                  </tr>
                </tbody>
              </table>
            </x-adminlte-card>
          </div>
          <div class="col-sm text-center">
            <x-adminlte-card title="5 Clientes con mayores compras" theme="info" icon="fas fa-lg fa-clipboard-check" collapsible >
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Cliente</th>
                    <th>Cantidad dinero</th>
                    <th>Compras</th>
                  <tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
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
      let cDataCuenta = JSON.parse('<?= $dataCuentas; ?>');
      const ctx = document.getElementById('Meses');
      const ctxx = document.getElementById('Cuentas');

      createChart(ctx, cData.data, 'bar', cData.label);
      createChart(ctxx, cDataCuenta.data, 'bar', cDataCuenta.label);

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