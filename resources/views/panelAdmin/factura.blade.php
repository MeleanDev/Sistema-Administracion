@extends('adminlte.app')

@section('subtitle', 'Factura')
@section('content_header_title', 'Factura')
@section('content_header_subtitle', 'Generando Venta con Factura')

{{-- Sweetalert2 --}}
@section('plugins.Sweetalert2', true)

{{-- Select2 --}}
@section('plugins.Select2', true)

{{-- Content body: main page content --}}

@section('content_body')
<div class="p-3 mb-2">
    @include('panelAdmin.alert.alertas')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#guardarP">
        Agregar Producto
    </button>
    <button type="button" class="btn btn-success" id="createFacturaButton">
        Crear Factura
    </button>

    <!-- Modal -->
    <div class="modal fade" id="guardarP" tabindex="-1" role="dialog" aria-labelledby="guardarP" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <h2 class="font-weight-bold" style="margin: 0auto; text-align:center">Elije un Producto para la factura</h2>
                <br>
                <form method="POST" action="{{route('Factura.guardarPro')}}">
                    @csrf
                    <div class="form-group">
                        <label for="producto">Selecciona el Producto</label>
                        <select class="form-control" id="producto" name="producto" style="width: 100%">
                            <option></option>
                            @foreach ($productos as $item)
                                @if ($item->cantidad === 0)
                                    
                                @else
                                    <option value="{{$item->id}}">{{$item->nombre}} - {{$item->precio}} Bs.s - Disponibles: {{$item->cantidad}}</option>
                                @endif
                            @endforeach
                        </select>
                        <small id="producto" class="form-text text-muted">Primero dice el nombre y luego la cantidad (Nombre - cantida disponible).</small>
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Cantidad a Facturar</label>
                        <input type="number" name="cantidad" class="form-control" id="cantidad" aria-describedby="cantidad" placeholder="cantidad"  min="1">
                        <small id="cantidad" class="form-text text-muted">Recuerde poner una cantidad menor a la disponible.</small>
                      </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar Producto</button>
            </div>
        </form>
        </div>
        </div>
    </div>


</div>
<div class="p-3 mb-2">
    <form action="#">
        @csrf
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label>Nombre y Apellido del Cliente</label>
                    <input type="text" class="form-control" value="@foreach ($dataF as $item){{$item->nombre}} {{$item->apellido}}@endforeach" readonly>
                </div>
                <div class="col">
                    <label>Cedula del Cliente</label>
                    <input type="text" class="form-control" value="@foreach ($dataF as $item){{$item->cedula}}@endforeach" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label>Nombre Del Admin</label>
                    <input type="text" class="form-control" value="@foreach ($dataF as $item){{$item->admin}}@endforeach" readonly>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row bg-dark">
                <div class="col">
                    <label for="cantidad">Total a pagar</label>
                    <p>Precio total: ${{ $precioTotal }}</p>
                </div>
                <div class="col">
                    <label for="cantidad">Codigo Factura</label>
                    <p>Codigo: @foreach ($dataF as $item){{$item->factura}}@endforeach</p>
                </div>
            </div>
          </div>
    </form>
</div>
<div class="p-3 mb-2">
    <table id="registros" class="table table-striped" style="width:100%">
        <thead class="p-3 mb-2 bg-info text-white">
            <tr>
                <th class="text-center">Num</th>
                <th class="text-center">productos</th>
                <th class="text-center">Precio Unid.</th>
                <th class="text-center">cantidad</th>
                <th class="text-center">Precio Total</th>
                <th class="text-center">Accion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productoF as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td class="text-center">{{$item->producto}}</td>
                    <td class="text-center">{{$item->precioUni}}</td>
                    <td class="text-center">{{$item->cantidad}}</td>
                    <td class="text-center">{{$item->precio}}</td>
                    <td class="text-center">
                        <a href="{{route('Factura.eliminar',$item->id)}}" class="btn btn-danger btn-san"><i class="fa fa-trash"> Eliminar</i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="p-3 mb-2 bg-info text-white">
            <tr>
                <th class="text-center">Num</th>
                <th class="text-center">productos</th>
                <th class="text-center">Precio Unid.</th>
                <th class="text-center">cantidad</th>
                <th class="text-center">Precio Total</th>
                <th class="text-center">Accion</th>
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
        $(document).ready(function() {
            $('#producto').select2({
                dropdownParent: $('#guardarP'),
                width: 'resolve',
                theme: "classic",
                placeholder: "Selecciona un Producto",
            });
        });
    </script>
    <script>
        const createFacturaButton = document.getElementById('createFacturaButton');

        createFacturaButton.addEventListener('click', () => {
        Swal.fire({
            title: '¿Está seguro de crear una factura?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, crear'
        }).then((result) => {
            if (result.isConfirmed) {
            // Redirect to the web page after confirmation
            const compraCrearRoute = '{{ route('Compra.crear') }}';
            window.location.href = compraCrearRoute;
            }
        });
        });
    </script>
@endpush