@extends('adminlte.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Empresa')
@section('content_header_title', 'Empresa')
@section('content_header_subtitle', 'Datos de la empresa')

{{-- Content body: main page content --}}

@section('content_body')
<div class="container">
    @include('panelAdmin.alert.alertas')
    <h1 class="text-center">Datos para la factura</h1>
    <form method="POST" action="{{route('Empresa.editar')}}">
        @csrf
        <div class="form-row mb-4">
            <div class="form-group col-md-6">
                <label for="nombre">Nombre Empresa</label>
                <input type="text" class="form-control" name="nombre" id="nombre" @if ($empresa) 
                                                                    value="{{$empresa->nombre}}" 
                                                                    @endif 
                                                                    placeholder="Nombre de la empresa" required>
            </div>
            <div class="form-group col-md-6">
                <label for="telefono">Telefono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" @if ($empresa) 
                                                                        value="{{$empresa->telefono}}" 
                                                                        @endif 
                                                                        placeholder="Telefono de la empresa" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="correo">Correo de la Empresa</label>
                <input type="email" class="form-control" name="correo" id="correo" @if ($empresa) 
                                                                    value="{{$empresa->correo}}" 
                                                                    @endif 
                                                                    placeholder="Correo de la Empresa" required>
            </div>
            <div class="form-group col-md-6">
                <label for="direccion">Direccion de la Empresa</label>
                <input type="text" class="form-control" name="direccion" id="direccion" @if ($empresa) 
                                                                        value="{{$empresa->direccion}}" 
                                                                        @endif 
                                                                        placeholder="Direccion de la Empresa" required>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>

    </form>
</div>
@stop