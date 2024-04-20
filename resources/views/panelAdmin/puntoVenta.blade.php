@extends('adminlte.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Punto de venta')
@section('content_header_title', 'Punto de venta')
@section('content_header_subtitle', 'General venta')

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