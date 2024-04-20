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
      <div class="">
        <button class="btn btn-info mb-3">General Informe PDF</button>
      </div>
      <div class="informacion">
        <div class="row">
            <div class="col-sm" style="width: 100%">
              <x-adminlte-card body-class="bg-white" title="Recaudacion por mes del Años 2024" theme="info" icon="fas fa-lg fa-chart-bar" collapsible>
                <div>
                  <canvas id="Meses"></canvas>
                </div>
              </x-adminlte-card>
            </div>
            <div class="col-sm" style="width: 100%">
              <x-adminlte-card body-class="bg-white" title="Recaudacion en distinto medios de pago 2024" theme="info" icon="fas fa-lg fa-chart-bar" collapsible>
                <div>
                  <canvas id="Cuentas"></canvas>
                </div>
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
      createChart(ctxx, cDataCuenta.data, 'line', cDataCuenta.label);

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