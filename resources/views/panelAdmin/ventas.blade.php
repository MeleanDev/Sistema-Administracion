@extends('adminlte.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Ventas')
@section('content_header_title', 'Ventas')
@section('content_header_subtitle', 'Registros')

{{-- plugins --}}
  {{-- Datatable --}}
    @section('plugins.Datatables', true)
  {{-- Sweetalert2 --}}
    @section('plugins.Sweetalert2', true)
    
{{-- Content body: main page content --}}

@section('content_body')
    <div class="container">
        
    </div>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    
@endpush