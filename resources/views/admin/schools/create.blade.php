@extends('adminlte::page')

@section('title', 'UNASAM')

@section('content_header')
    <div class="d-flex flex-row justify-content-between">
        <h1 class="font-weight-bold">REGISTRAR ESCUELA</h1>
        <a href="{{ route('admin.schools.index') }}" class="btn btn-secondary mb-4"><i class="fas fa-arrow-left"></i>
            VOLVER</a>
    </div>
@stop

@section('content')

    @livewire('admin.schools.form-create')

@stop

@section('footer')
    <p class="text-center">Universidad Nacional Santiago Antunez de Mayolo</p>
@stop

@section('css')

@stop

@section('js')
    <script src="{{ asset('js/admin/message_forms.js') }}"></script>
@stop
