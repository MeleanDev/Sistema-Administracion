@extends('adminlte.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Productos')
@section('content_header_title', 'Productos')
@section('content_header_subtitle', 'Registros')

{{-- plugins --}}
  {{-- Datatable --}}
    @section('plugins.Datatables', true)
  {{-- Sweetalert2 --}}
    @section('plugins.Sweetalert2', true)
    {{-- Select2 --}}
    @section('plugins.Select2', true)
    
{{-- Content body: main page content --}}

@section('content_body')
    <div class="container">
        <div class="mb-3">
          <button type="button" class="btn btn-primary" data-toggle="modal" id="btnNuevo">
            Crear Producto
          </button>
        </div>  
        <div class="table-responsive-md">
            <table class="table table-striped table-hover" cellspacing="0" id="datatable" style="width: 100%">
                    <thead class="bg-info">
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>  
                            <th>Proveedor</th>  
                            <th>Cantidad</th>  
                            <th>Precio</th>  
                            <th class="text-center">Accion</th>                
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot class="bg-info">
                        <tr>
                          <th>Nombre</th>
                          <th>Descripcion</th>  
                          <th>Proveedor</th>  
                          <th>Cantidad</th>  
                          <th>Precio</th>  
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
                <div class="form-group text-center"> 
                    <label for="nombre">Nombre</label> 
                    <input type="text" class="form-control" id="nombre" required placeholder="Nombre"> 
                    <small id="nombre" class="form-text text-muted">Nombre del Producto.</small> 
                </div> 
                <div class="form-group text-center"> 
                    <label for="descripcion">descripcion</label> 
                    <input type="text" class="form-control" id="descripcion" required placeholder="Descripcion">
                    <small id="descripcion" class="form-text text-muted">Descripcion corta del Producto.</small>  
                </div> 
                <div class="form-group text-center">
                  <label for="proveedor">Proveedor del Producto</label>
                  <select class="form-control mb-2" id="proveedor" name="proveedor" style="width: 100%" required>
                    <option></option>  
                    <option value="Sin Proveedor">Sin Proveedor</option>  
                    @foreach ($proveedores as $item)
                          <option value="{{$item->nombre}}">{{$item->nombre}}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-row justify-content-around">
                <div class="form-group col-md-5"> 
                    <label for="cantidad">cantidad disponible</label> 
                    <input type="number" class="form-control" id="cantidad" required placeholder="cantidad" min="0">
                    <small id="cantidad" class="form-text text-muted">Cantidad disponible.</small> 
                </div> 
                <div class="form-group col-md-5"> 
                    <label for="precio">precio del Producto</label> 
                    <input type="number" class="form-control" id="precio" required placeholder="precio" min="0"> 
                    <small id="precio" class="form-text text-muted">Precio del Producto.</small> 
                </div> 
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
<style>

</style>
@endpush

{{-- Push extra scripts --}}

@push('js')
<script>
    $(document).ready(function() {
      $('#proveedor').select2({
        dropdownParent: $('#modalCRUD'),
        width: 'resolve',
        theme: "classic",
        placeholder: "Selecciona una opcion",
      });
    });

    var id, opcion, fila;
    var token = $('meta[name="csrf-token"]').attr('content');
    
    var table = new DataTable('#datatable', {
        ajax: '{{route('Productos')}}',
        processing: true,
        serverSide: true,
        lengthMenu: [[10, 25, 50, 100],[10, 25, 50, 100]],
        columns: [
                {data: 'nombre', name: 'nombre', className: 'text-center'},
                {data: 'descripcion', name: 'descripcion', className: 'text-center'},         
                {data: 'proveedor', name: 'proveedor', className: 'text-center'},  
                {data: 'cantidad', name: 'cantidad', className: 'text-center'},         
                {data: 'precio', name: 'precio', className: 'text-center'}, 
                {"defaultContent": "<div class=\"dropdown text-center\"><button class=\"btn btn-primary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"> Acción </button><div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\"><button class='dropdown-item bg-warning text-light btnEditar'><i class='fas fa-edit'> Editar</i></button><button class='dropdown-item bg-danger text-light btnBorrar'><i class='fas fa-lg fa-trash'> Eliminar</i></button></div></div>"}
        ],
            columnDefs: [{orderable: false, targets: 5}],
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
      descripcion = $.trim($('#descripcion').val());
      proveedor = $.trim($('#proveedor').val());
      cantidad = $.trim($('#cantidad').val());
      precio = $.trim($('#precio').val());

        $.ajax({
          url: opcion === 1 ? "{{ route('Productos.crear') }}" : "{{ route('Productos.editar') }}",
          type: "POST",
          datatype: "json",
          data: {
            _token: token,
            id: opcion === 2 ? id : null,
            nombre: nombre,
            descripcion: descripcion,
            proveedor: proveedor,
            cantidad: cantidad,
            precio: precio,
          },
          success: function(data) {
            if (data.success) {
              table.ajax.reload(null, false);
            if (opcion === 1) {
              Swal.fire({
                title: "Producto Agregado",
                text: "El registro fue agregado al sistema",
                icon: "success"
                }); 
            } else {
                Swal.fire({
                title: "Producto Editado",
                text: "El registro fue editado en el sistema",
                icon: "info",
                timer: 2000,
                showConfirmButton: false,
                timerProgressBar: true
                }); 
            }
            } else {
              Swal.fire({
              title: "Producto No Agregado",
              text: "El registro no fue agregado al sistema",
              icon: "error"
            });
            }
          },
          error: function(xhr, status, error) {
            Swal.fire({
              title: "Producto No Agregado",
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
        $("#proveedor").val("");
        $('#proveedor').trigger('change');    
        $("#formulario").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Nuevo Producto");
        $('#modalCRUD').modal('show');	    
    });
    
    //Editar        
    $(document).on("click", ".btnEditar", function(){	
        opcion = 2; //editar
        fila = $(this).closest("tr");	        
        id = fila.find('td:eq(0)').text(); //capturo el ID	
                        
        nombre = fila.find('td:eq(0)').text();
        descripcion = fila.find('td:eq(1)').text();
        proveedor = fila.find('td:eq(2)').text();
        cantidad = parseInt(fila.find('td:eq(3)').text());
        precio = parseInt(fila.find('td:eq(4)').text());

        $("#nombre").val(nombre);
        $("#descripcion").val(descripcion);
        $("#proveedor").val(proveedor);
        $('#proveedor').trigger('change');
        $("#cantidad").val(cantidad);
        $("#precio").val(precio);

        $(".modal-header").css("background-color", "rgb(147 131 29)");
        $(".modal-title").text("Editar Producto ( " + id + " )");		
        $('#modalCRUD').modal('show');		   
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
            url: "{{route('Productos.eliminar')}}",
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