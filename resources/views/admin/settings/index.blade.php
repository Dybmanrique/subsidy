@extends('adminlte::page')

@section('title', 'UNASAM')

@section('content_header')
    <h1 class="font-weight-bold">PARÁMETROS</h1>
@stop

@section('content')
    @livewire('admin.settings.form')
@stop

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css"
        rel="stylesheet" />
@stop

@section('js')
    <script src="{{ asset('js/admin/message_forms.js') }}"></script>
@stop
