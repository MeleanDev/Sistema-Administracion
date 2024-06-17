@extends('adminlte.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Clientes')
@section('content_header_title', 'Clientes')
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
    <button type="button" class="btn btn-primary" data-toggle="modal" id="btnNuevo">
      Crear Cliente
    </button>
  </div>  
  <div class="table-responsive-md">
      <table class="table table-striped table-hover" cellspacing="0" id="datatable" style="width: 100%">
              <thead class="bg-info">
                <tr>
                  <th>Nombre</th>
                  <th>Apellido</th>  
                  <th>Cedula</th>  
                  <th>Telefono</th>  
                  <th class="text-center">Accion</th>                  
                </tr>
              </thead>
              <tbody>
              </tbody>
              <tfoot class="bg-info">
                  <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>  
                    <th>Cedula</th>  
                    <th>Telefono</th>  
                    <th class="text-center">Accion</th>                  
                  </tr>
              </tfoot>
      </table>
  </div>
</div>  

<!-- Modal -->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title"></h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      </div>
      <div class="modal-body">
          <form id="formulario" enctype="application/x-www-form-urlencoded">
              @csrf
          <div class="form-group"> 
              <label for="nombre">Nombre</label> 
              <input type="text" class="form-control" required id="nombre" placeholder="Nombre"> 
          </div> 
          <div class="form-group"> 
              <label for="apellido">Apellido</label> 
              <input type="text" class="form-control" required id="apellido" placeholder="Apellido"> 
          </div> 
          <div class="form-group"> 
              <label for="cedula">Cedula</label> 
              <input type="text" class="form-control" required id="cedula" placeholder="Cedula"> 
          </div> 
          <div class="form-group"> 
              <label for="telefono">Telefono</label> 
              <input type="text" class="form-control" required id="telefono" placeholder="Telefono"> 
          </div> 
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      <button type="submit" id="btn" class="btn btn-primary"><i class="fas fa-lg fa-save"></i> Guarda</button>
      </div>
  </form>
  </div>
  </div>
</div>
@stop

{{-- Push extra CSS --}}

@push('css')
@endpush

{{-- Push extra scripts --}}

@push('js')
<script>

  var id, opcion, fila;
  var token = $('meta[name="csrf-token"]').attr('content');
  
  var table = new DataTable('#datatable', {
      ajax: '{{route('Clientes')}}',
      processing: true,
      serverSide: true,
      lengthMenu: [[10, 25, 50, 100],[10, 25, 50, 100]],
      columns: [
              {data: 'nombre', name: 'nombre', className: 'text-center'},
              {data: 'apellido', name: 'apellido', className: 'text-center'},         
              {data: 'cedula', name: 'cedula', className: 'text-center'},  
              {data: 'telefono', name: 'telefono', className: 'text-center'},         
              {"defaultContent": "<div class=\"dropdown text-center\"><button class=\"btn btn-primary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"> Acción </button><div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\"><button class='dropdown-item bg-warning text-light btnEditar'><i class='fas fa-edit'> Editar</i></button><button class='dropdown-item bg-danger text-light btnBorrar'><i class='fas fa-lg fa-trash'> Eliminar</i></button></div></div>"}
      ],
          columnDefs: [{orderable: false, targets: 4}],
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
  
  //submit para el Crear y Actualización
  $('#formulario').submit(function(e){

    e.preventDefault(); // Previene el recargo de la página

    nombre = $.trim($('#nombre').val());
    apellido = $.trim($('#apellido').val());
    cedula = $.trim($('#cedula').val());
    telefono = $.trim($('#telefono').val());

      $.ajax({
        url: opcion === 1 ? "{{ route('Clientes.crear') }}" : "{{ route('Clientes.editar') }}",
        type: "POST",
        datatype: "json",
        data: {
          _token: token,
          id: opcion === 2 ? id : null,
          nombre: nombre,
          apellido: apellido,
          cedula: cedula,
          telefono: telefono,
        },
        success: function(data) {
          if (data.success) {
            table.ajax.reload(null, false);
          if (opcion === 1) {
            Swal.fire({
              title: "Cliente Agregado",
              text: "El registro fue agregado al sistema",
              icon: "success"
              }); 
          } else {
              Swal.fire({
              title: "Cliente Editado",
              text: "El registro fue editado en el sistema",
              icon: "info",
              timer: 2000,
              showConfirmButton: false,
              timerProgressBar: true
              }); 
          }
          } else {
            Swal.fire({
            title: "Cliente No Agregado",
            text: "El registro no fue agregado al sistema",
            icon: "error"
          });
          }
        },
        error: function(xhr, status, error) {
          Swal.fire({
            title: "Cliente No Agregado",
            text: "El registro no fue agregado al sistema",
            icon: "error"
          });
        }
      });
  
    $('#modalCRUD').modal('hide'); // Cierra el modal después de la solicitud AJAX
  });
  
   //para limpiar los campos antes de dar de Crear una Registro
  $("#btnNuevo").click(function(){
      opcion = 1; //alta           
      $("#formulario").trigger("reset");
      $(".modal-header").css( "background-color", "#17a2b8");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Nuevo Cliente");
      $('#modalCRUD').modal('show');	    
  });
  
  //Editar        
  $(document).on("click", ".btnEditar", function(){	
      opcion = 2; //editar
  
      fila = $(this).closest("tr");	        
      id = fila.find('td:eq(2)').text(); //capturo el ID	
                      
      nombre = fila.find('td:eq(0)').text();
      apellido = fila.find('td:eq(1)').text();
      cedula = fila.find('td:eq(2)').text();
      telefono = fila.find('td:eq(3)').text();

      $("#nombre").val(nombre);
      $("#apellido").val(apellido);
      $("#cedula").val(cedula);
      $("#telefono").val(telefono);

      $(".modal-header").css("background-color", "rgb(147 131 29)");
      $(".modal-title").text("Editar Cliente ( " + id + " )");		
      $('#modalCRUD').modal('show');		   
  });
  
  //Borrar
  $(document).on("click", ".btnBorrar", function(){
    fila = $(this);
    id = $(this).closest('tr').find('td:eq(2)').text();
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