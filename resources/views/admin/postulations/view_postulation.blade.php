@extends('adminlte::page')

@section('title', 'UNASAM')

@section('content_header')
    <h1>VISUALIZAR DOCUMENTOS</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header font-weight-bold">
                    LISTA DE DOCUMENTOS
                </div>
                <div class="card-body">

                    <div class="btn-group-vertical w-100 btn-group-toggle" data-toggle="buttons">
                        @foreach ($postulation->requirements as $requirement)
                            <label class="btn btn-outline-dark">
                                <input class="btn-documento" type="radio" name="options" id="option{{ $requirement->id }}"
                                    data-file = "{{ Storage::url($requirement->pivot->file) }}"> {{ $requirement->name }}
                            </label>
                        @endforeach
                    </div>

                </div>
            </div>
            @livewire('admin.postulations.form-actions', ['postulation' => $postulation])
        </div>
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header font-weight-bold">
                    VISUALIZADOR
                </div>
                <div class="card-body">
                    <iframe id="previsualizador" src="" style="width:100%; height:700px;" frameborder="0"></iframe>
                </div>
            </div>
        </div>

    </div>
@stop

@section('footer')
    <p class="text-center">Universidad Nacional Santiago Antunez de Mayolo</p>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop
