@extends('adminlte::page')

@section('title', 'UNASAM')

@section('content_header')
    <h1>CREAR USUARIO</h1>
@stop

@section('content')
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mb-4"><i class="fas fa-arrow-left"></i>
        Volver</a>
        
        @livewire('admin.users.form-create')

@stop

@section('footer')
    <p class="text-center">Universidad Nacional Santiago Antunez de Mayolo</p>
@stop

@section('css')

@stop

@section('js')
    <script src="{{asset('js/admin/message_forms.js')}}"></script>
@stop