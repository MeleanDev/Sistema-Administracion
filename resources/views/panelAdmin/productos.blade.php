@extends('adminlte.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Productos')
@section('content_header_title', 'Productos')
@section('content_header_subtitle', 'Registros')

{{-- Content body: main page content --}}

@section('content_body')
    
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    
@endpush