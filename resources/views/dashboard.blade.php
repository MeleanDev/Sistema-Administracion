@extends('adminlte.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Panel Principal')
@section('content_header_title', 'Inicio')
@section('content_header_subtitle', 'Panel Principal')

{{-- Content body: main page content --}}

@section('content_body')
    <div class="container">
        <div class="Bienvenida">
            <div class="col-lg-10 mb-4 order-0 mx-auto">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-black">Bienvenido {{auth()->user()->name}}!! 😎🎉</h5>
                                <p class="mb-2">
                                    <br>Al sistema de administracion de tu comercio. <br><br>Sistema desarrollado por MeleanDev.
                                </p>
                        
                                <a href="https://instagram.com/MeleanDev" target="_blank" class="btn btn-sm btn-primary">Contactar con el Desarrollador</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img
                                src="{{ asset("img/panelcard.png") }}"
                                height="140"
                                alt="img del sistema"
                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cartas">
            <div class="row">
                <div class="col-sm">
                    <x-adminlte-small-box title="{{$admins}}" text="Administradores" icon="fas fa-user-shield text-white"
                    theme="success" url="{{route('Administradores')}}" url-text="Ver Administradores"/>
                </div>
                <div class="col-sm">
                    <x-adminlte-small-box title="{{$clientes}}" text="Clientes" icon="fas fa-address-book text-white"
                    theme="danger" url="{{route('Clientes')}}" url-text="Ver Clientes"/>
                </div>
                <div class="col-sm">
                    <x-adminlte-small-box title="{{$productos}}" text="Productos" icon="fas fa-boxes text-white"
                    theme="info" url="{{route('Productos')}}" url-text="Ver Productos"/>
                </div>
              </div>
        </div>
        <div class="informacion">
            <div class="row">
                <div class="col-sm">
                    <x-adminlte-card title="Recaudado este Mes" theme="purple" icon="fas fa-lg fa-calculator" collapsible>
                        <dt class="text-center" style="font-size: 30px">{{$datosMes->mes}}: {{$datosMes->cantidad}} Bs.s</dt>
                    </x-adminlte-card>
                </div>
                <div class="col-sm">
                    <x-adminlte-card title="Facturas realizadas este Mes" theme="purple" icon="fas fa-lg fa-file" collapsible>
                        <dt class="text-center" style="font-size: 30px">Total: {{$datosMes->Compras}}</dt>
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
    <script>
        
    </script>
@endpush