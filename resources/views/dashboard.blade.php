@extends('adminlte.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Panel Principal')
@section('content_header_title', 'Inicio')
@section('content_header_subtitle', 'Panel Principal')

{{-- Content body: main page content --}}

@section('content_body')
    <div class="container">
        <div class="col-lg-8 mb-4 order-0 mx-auto">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-warning">Bienvenido {{auth()->user()->name}}!! 😎🎉</h5>
                            <p class="mb-2">
                                <br>Al sistema de administracion de tu comercio. <br><br>Sistema desarrollado por MeleanDev.
                            </p>
                    
                            <a href="https://github.com/MeleanDev" class="btn btn-sm btn-outline-warning">Contactar con el Desarrollador</a>
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