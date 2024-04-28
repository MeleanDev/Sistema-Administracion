@extends('adminlte.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Punto de venta')
@section('content_header_title', 'Punto de venta')
@section('content_header_subtitle', 'General venta')

{{-- plugins --}}
  {{-- Datatable --}}
  @section('plugins.Datatables', true)
  {{-- Select2 --}}
  @section('plugins.Select2', true)
  {{-- Sweetalert2 --}}
  @section('plugins.Sweetalert2', true)

{{-- Content body: main page content --}}

@section('content_body')
<div class="container">
  @include('panelAdmin.alert.alertas')
    <div class="mb-3">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#crear">
            Crear Nueva Factura
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imprimir">
          Imprimir Factura
      </button>
        @if ($existeRegistro)
          <a href="{{route('Factura.crear')}}" class="btn btn-info">
            Volver a La Ultima Factura
          </a>
        @endif

    </div> 
    <div class="tablaVentas">
        <div class="table-responsive-md">
            <table class="table table-striped table-hover" cellspacing="0" id="datatable" style="width: 100%">
                    <thead class="bg-info">
                        <tr>
                          <th>Factura</th>
                          <th>Admin</th>
                          <th>Cliente</th>  
                          <th>Cedula Cliente</th>  
                          <th>Cantidad Productos</th>  
                          <th>Total Compra</th>  
                            <th class="text-center">Accion</th>                  
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot class="bg-info">
                        <tr>
                            <th>Factura</th>
                            <th>Admin</th>
                            <th>Cliente</th>  
                            <th>Cedula Cliente</th>  
                            <th>Cantidad Productos</th>  
                            <th>Total Compra</th>  
                            <th class="text-center">Accion</th>                
                        </tr>
                    </tfoot>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crear" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Crear Nueva Factura</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <h2 class="font-weight-bold" style="margin: 0auto; text-align:center">Elije un cliente para la factura</h2>
                <br>
                <form method="post" action="{{route('PuntoVentas.crear')}}" >
                    @csrf
                    <div class="form-group mb-3">
                        <label for="clientes" class="">Selecciona el cliente</label>
                        <select class="form-control" id="clientes" name="cliente" style="width: 100%" required>
                            <option></option>
                            @foreach ($clientes as $item)
                                <option value="{{$item->id}}">{{$item->nombre}} {{$item->apellido}} - {{$item->cedula}}</option>
                            @endforeach
                        </select>
                        <small id="clientes" class="form-text text-muted">Elija un cliente para la factura.</small> 
                    </div>
                    <div class="form-group">
                        <label for="factura">Codigo para la factura</label>
                        <input type="text" name="factura" class="form-control" id="factura" aria-describedby="factura" placeholder="codigo" pattern="^[a-zA-Z0-9]+$" title="Solo se permiten números y letras sin espacios" required>
                        <small id="factura" class="form-text text-muted">Solo Numeros y Letras sin espacios.</small> 
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Crear Factura</button>
            </div>
        </form>
        </div>
        </div>
    </div>
    <!-- Modal Imprimir-->
    <div class="modal fade" id="imprimir" tabindex="-1" role="dialog" aria-labelledby="imprimir" aria-hidden="true">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header bg-info">
          <h5 class="modal-title" id="exampleModalLabel">Imprimir Factura</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          </div>
          <div class="modal-body">
              <h2 class="font-weight-bold" style="margin: 0auto; text-align:center">Elije una Factura para Imprimir</h2>
              <br>
              <form method="post" action="{{route('Factura.imprimir')}}">
                  @csrf
                  <div class="form-group mb-3">
                      <label for="imprime" class="">Selecciona la Factura</label>
                      <select class="form-control" id="imprime" name="imprime" style="width: 100%" required>
                          <option></option>
                          @foreach ($facturas as $item)
                              <option value="{{$item->factura}}">{{$item->nombre}} V{{$item->cedula}} - Factura: {{$item->factura}}</option>
                          @endforeach
                      </select>
                      <small id="clientes" class="form-text text-muted">Formato: Cliente Cedula - Factura.</small> 
                  </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Imprimir Factura</button>
          </div>
      </form>
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
<script>

$(document).ready(function() {
      $('#clientes').select2({
        dropdownParent: $('#crear'),
        width: 'resolve',
        theme: "classic",
        placeholder: "Selecciona un Cliente",
      });
});

$(document).ready(function() {
      $('#imprime').select2({
        dropdownParent: $('#imprimir'),
        width: 'resolve',
        theme: "classic",
        placeholder: "Selecciona una Factura",
      });
});

var id, fila;
var token = $('meta[name="csrf-token"]').attr('content');

var table = new DataTable('#datatable', {
        ajax: '{{route('PuntoVentas')}}',
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, 100],[10, 25, 50, 100]],
        columns: [
                {data: 'factura', name: 'factura', className: 'text-center'},
                {data: 'admin', name: 'admin', className: 'text-center'},
                {data: 'nombre', name: 'nombre', className: 'text-center'},         
                {data: 'cedula', name: 'cedula', className: 'text-center'},  
                {data: 'cantidadProducto', name: 'cantidadProducto', className: 'text-center'},         
                {data: 'totalCompra', name: 'totalCompra', className: 'text-center'}, 
                {"defaultContent": "<div class=\"dropdown text-center\"><button class=\"btn btn-primary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"> Acción </button><div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\"><button class='dropdown-item bg-danger text-light btnBorrar'><i class='fas fa-lg fa-trash'> Eliminar</i></button></div></div>"}
        ],order: [[0, 'desc']],
            columnDefs: [{orderable: false, targets: 6}],
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
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
      fila = $(this);
      id = $(this).closest('tr').find('td:eq(0)').text();
      Swal.fire({
        title: '¿ Estas seguro que desea eliminar el registro #'+(id.toString())+' ?',
        text: "¡ No podrás revertir esto !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '¡ Sí, bórralo !',
      }).then((result) => {
        if (result.isConfirmed){
          $.ajax({
            url: "{{route('PuntoVentas.borrar')}}",
            type: "post",
            datatype:"json",
            data: {
              _token: token,
              id:id
            },
            success: function(data) {
              if (data.success) {
                // Eliminar la fila de la tabla
                table.row('#' + id).remove().draw();
            
                // Mostrar mensaje de éxito con temporizador
                Swal.fire({
                  title: '¡ Eliminado !',
                  text: 'Tu registro ha sido eliminado.',
                  icon: 'success',
                  timer: 2000,
                  showConfirmButton: false,
                  timerProgressBar: true,
                });

                const PuntoVentas = '{{ route('PuntoVentas') }}';
                window.location.href = PuntoVentas;
              } else {
                // Mostrar mensaje de error
                Swal.fire({
                  title: '¡ Error !',
                  text: 'Tu registro no ha sido eliminado.',
                  icon: 'error',
                  timer: 2000,
                  showConfirmButton: false,
                  timerProgressBar: true,
                });
              }
            }
          });
        }
      });
    }); 

</script>
@endpush