@extends('adminlte.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Metodos de pagos')
@section('content_header_title', 'Metodos de pagos')
@section('content_header_subtitle', 'Registros')

{{-- plugins --}}
  {{-- Datatable --}}
    @section('plugins.Datatables', true)
  {{-- Sweetalert2 --}}
    @section('plugins.Sweetalert2', true)
    
{{-- Content body: main page content --}}

@section('content_body')
<div class="container">
  @include('panelAdmin.alert.alertas')
          <!-- Button trigger modal -->
          <div class="mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#guardar">
                Agregar Nuevo Metodo de Pago
            </button>
          </div>
      
      <!-- Modal -->
      <div class="modal fade" id="guardar" tabindex="-1" role="dialog" aria-labelledby="guardar" aria-hidden="true">
          <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header bg-info">
              <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Metodo de Pago</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              </div>
              <div class="modal-body">
                  <form method="POST" action="{{route('MetodosPagos.guardar')}}">
                      @csrf
                      <div class="form-row">
                          <div class="form-group col-md-6">
                              <label for="Usuario">Nombre del metodo de pago</label>
                              <input type="text" class="form-control" placeholder="Nombre del metodo de pago" name="tipo">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="banco">Nombre del banco</label>
                            <input type="text" class="form-control" placeholder="Nombre del banco" name="banco">
                          </div>
                      </div>
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
          </form>
          </div>
          </div>
      </div>

  <table id="datatable" class="table table-striped" style="width:100%">
      <thead class="p-3 mb-2 bg-info text-white">
          <tr>
              <th class="text-center" style="width: 40%">Metodo de pago</th>
              <th class="text-center" style="width: 40%">Banco</th>
              <th class="text-center" style="width: 20%">Accion</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($datos as $item)
              <tr>
                  <td class="text-center">{{$item->tipo}}</td>
                  <td class="text-center">{{$item->banco}}</td>
                  <td class="text-center">
                      <div class="dropdown">
                          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Acciones
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item bg-warning" href="#" data-toggle="modal" data-target="#exampleModal{{$item->id}}"><i class='fas fa-edit'></i>Editar</a>
                              <a class="dropdown-item bg-danger" href="{{route("MetodosPagos.eliminar",$item->id)}}"><i class='fas fa-trash-alt'></i> Eliminar</a>
                          </div>
                          <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header bg-warning">
                                  <h5 class="modal-title" id="exampleModalLabel">Editar Metodo de pago</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                                  </div>
                                  <div class="modal-body">
                                      <form action="{{ route("MetodosPagos.editar", $item->id) }}"method="POST">
                                          @method('put')
                                          @csrf
                                          <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="Usuario">Nombre del metodo de pago</label>
                                                <input type="text" class="form-control" value="{{$item->tipo}}" placeholder="Nombre del metodo de pago" name="tipo">
                                            </div>
                                            <div class="form-group col-md-6">
                                              <label for="banco">Nombre del banco</label>
                                              <input type="text" class="form-control" value="{{$item->banco}}" placeholder="Nombre del banco" name="banco">
                                            </div>
                                        </div>
                                  </div>
                                  <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                  <button type="submit" class="btn btn-primary">Guardar</button>
                                  </div>
                              </form>
                              </div>
                              </div>
                          </div>
                      </div>
                  </td>
              </tr>
          @endforeach
      </tbody>
      <tfoot class="p-3 mb-2 bg-info text-white">
          <tr>
            <th class="text-center" style="width: 40%">Metodo de pago</th>
            <th class="text-center" style="width: 40%">Banco</th>
            <th class="text-center" style="width: 20%">Accion</th>
          </tr>
      </tfoot>
  </table>
</div>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
<script>
  var table = new DataTable('#datatable', {
    columnDefs: [{orderable: false, targets: 2}],
    lengthMenu: [[10, 25, 50, 100],[10, 25, 50, 100]],
    language: {
                  "zeroRecords": "No se encontraron resultados",
                  "emptyTable": "Ningún dato disponible en esta tabla",
                  "lengthMenu": "Mostrar _MENU_ registros",
                  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                  "sSearch": "Buscar:",
                  "oPaginate": {
                      "sFirst": "Primero",
                      "sLast":"Último",
                      "sNext":"Siguiente",
                      "sPrevious": "Anterior"
                   },
                   "sProcessing":"Procesando...",
          },
  });
</script>
@endpush