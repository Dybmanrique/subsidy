@extends('adminlte::page')

@section('title', 'UNASAM')

@section('content_header')
    <h1>CREAR SUBVENCION</h1>
@stop

@section('content')
    <a href="{{ route('admin.subsidies.index') }}" class="btn btn-secondary mb-4"><i class="fas fa-arrow-left"></i>
        Volver</a>

    @livewire('admin.subsidies.form-create')

@stop

@section('footer')
    <p class="text-center">Universidad Nacional Santiago Antunez de Mayolo</p>
@stop

@section('css')

@stop

@section('js')
    
@stop
