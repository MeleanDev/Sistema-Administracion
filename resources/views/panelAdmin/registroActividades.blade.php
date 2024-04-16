@extends('adminlte.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Actividades registradas')
@section('content_header_title', 'Actividades registradas')
@section('content_header_subtitle', 'Registros')

{{-- plugins --}}
  {{-- Datatable --}}
    @section('plugins.Datatables', true)
  {{-- Sweetalert2 --}}
    @section('plugins.Sweetalert2', true)
    
{{-- Content body: main page content --}}

@section('content_body')
<div class="container">
  <div class="mb-3">
    <button type="button" class="btn btn-danger" id="Borrar">
      Borrar todos los registros
    </button>
  </div>  
  <div class="table-responsive-md">
      <table class="table table-striped table-hover" cellspacing="0" id="datatable" style="width: 100%">
              <thead class="bg-info">
                  <tr>
                      <th>Usuario</th>
                      <th>Accion</th>  
                      <th>Fecha y hora</th>           
                  </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot class="bg-info">
                  <tr>
                      <th>Usuario</th>
                      <th>Accion</th>  
                      <th>Fecha y hora</th>                
                  </tr>
              </tfoot>
      </table>
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

  const seguro = 1;
  var token = $('meta[name="csrf-token"]').attr('content');
  
  var table = new DataTable('#datatable', {
      ajax: '{{route('RegistroActividades')}}',
      processing: true,
      serverSide: true,
      lengthMenu: [[10, 25, 50, 100],[10, 25, 50, 100]],
      columns: [
              {data: 'usuario', name: 'usuario', className: 'text-center'},
              {data: 'accion', name: 'accion', className: 'text-center'},         
              {data: 'last_login', name: 'last_login', className: 'text-center'},  
      ],  
          order: [[0, "desc"], [1, "desc"], [2, "desc"]],
          columnDefs: [{orderable: false, targets: [0,1]}],
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
  $(document).on("click", "#Borrar", function(){
    Swal.fire({
      title: '¿ Estas seguro que desea eliminar todos los registro ?',
      text: "¡ No podrás revertir esto !",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '¡ Sí, bórralo !',
    }).then((result) => {
      if (result.isConfirmed){
        $.ajax({
          url: "{{route('RegistroActividades.eliminar')}}",
          type: "POST",
          datatype:"json",
          data: {
            _token: token,
            seguro:seguro
          },
          success: function(data) {
            if (data.success) {

              table.ajax.reload(null, false);

              // Mostrar mensaje de éxito con temporizador
              Swal.fire({
                title: '¡ Eliminado !',
                text: 'Tu registros ha sido eliminado.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false,
                timerProgressBar: true,
              });
            } else {
              // Mostrar mensaje de error
              Swal.fire({
                title: '¡ Error !',
                text: 'Tu registros no han sido eliminado.',
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