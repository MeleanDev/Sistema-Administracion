@extends('adminlte.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Punto de venta')
@section('content_header_title', 'Punto de venta')
@section('content_header_subtitle', 'General venta')

{{-- Content body: main page content --}}

@section('content_body')
<div class="container">
    <div class="mb-3">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#crear">
            Crear Nueva Factura
        </button>
    </div> 
    <div class="tablaVentas">
        <div class="table-responsive-md">
            <table class="table table-striped table-hover" cellspacing="0" id="datatable" style="width: 100%">
                    <thead class="bg-info">
                        <tr>
                            <th>Admin</th>
                            <th>Cliente</th>  
                            <th>Cedula Cliente</th>  
                            <th>Cantidad Productos</th>  
                            <th>Factura</th>
                            <th>Total Compra</th>  
                            <th class="text-center">Accion</th>                  
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot class="bg-info">
                        <tr>
                            <th>Admin</th>
                            <th>Cliente</th>  
                            <th>Cedula Cliente</th>  
                            <th>Cantidad Productos</th>  
                            <th>Factura</th>
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
                        <select class="form-control" id="clientes" name="cliente">
                            <option selected>Selecciona un cliente</option>
                            @foreach ($clientes as $item)
                                <option value="{{$item->id}}">{{$item->nombre}} {{$item->apellido}} - {{$item->cedula}}</option>
                            @endforeach
                        </select>
                        <small id="clientes" class="form-text text-muted">Elija un cliente para la factura.</small> 
                    </div>
                    <div class="form-group">
                        <label for="factura">Codigo para la factura</label>
                        <input type="text" name="factura" class="form-control" id="factura" aria-describedby="factura" placeholder="codigo" pattern="^[a-zA-Z0-9]+$" title="Solo se permiten números y letras sin espacios">
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

var id, fila;
var token = $('meta[name="csrf-token"]').attr('content');
  
// Borrar
$(document).on("click", ".btnBorrar", function(){
    fila = $(this);
    id = $(this).closest('tr').find('td:eq(4)').text();
    Swal.fire({
      title: '¿ Estas seguro que desea eliminar el factura #'+(id.toString())+' ?',
      text: "¡ No podrás revertir esto !",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '¡ Sí, bórralo !',
    }).then((result) => {
      if (result.isConfirmed){
        $.ajax({
          url: "{{route('Clientes.eliminar')}}",
          type: "POST",
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