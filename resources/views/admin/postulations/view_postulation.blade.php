@extends('adminlte::page')

@section('title', 'UNASAM')

@section('content_header')
    <div class="d-flex flex-row justify-content-between">
        <h1 class="font-weight-bold">VISUALIZAR DOCUMENTOS</h1>
        <a class="btn btn-secondary text-uppercase"
            href="{{ route('admin.postulations.all_index', $postulation->announcement->subsidy) }}"><i
                class="fas fa-arrow-left"></i> Volver</a>
    </div>
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
                            <label class="btn btn-outline-dark text-uppercase">
                                <input class="btn-documento" type="radio" name="options"
                                    data-file="{{ Storage::url($requirement->pivot->file) }}"> {{ $requirement->name }}
                            </label>
                        @endforeach
                    </div>

                </div>
            </div>
            @livewire('admin.postulations.form-actions', ['postulation' => $postulation])
            <div class="card card-primary">
                <div class="card-header font-weight-bold">
                    HISTORIAL
                </div>
                <div class="card-body px-1">
                    <div class="timeline mb-1">

                        @foreach ($postulation->states as $state)
                        <div>
                            <i class="fas bg-blue"></i>
                            <div class="timeline-item">
                                <div class="timeline-header">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span class="time text-sm text-muted text-nowrap"><i class="fas fa-calendar"></i> {{ $state->created_at->format('d-m-Y') }}</span>
                                            <span class="time text-sm text-muted text-nowrap"><i class="fas fa-clock"></i> {{ $state->created_at->format('h:i A') }}</span>
                                        </div>
                                        <div>
                                            <a class="text-primary"><i class="fas fa-edit"></i></a>
                                            <a class="text-danger"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-body">
                                    <span class="font-weight-bold d-inline-block">{{ $state->name }}</span>
                                    <div>
                                        {{ $state->pivot->description }}
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header font-weight-bold">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <span>VISUALIZADOR</span>
                        @livewire('admin.postulations.black-list', ['postulation' => $postulation])
                    </div>
                </div>
                <div class="card-body">
                    <iframe id="previsualizador" src="" style="width:100%; height:700px;"frameborder="0"></iframe>
                </div>
            </div>
            <div class="">
                @if ($previous_id)
                    <a href="{{ route('admin.postulations.view_postulation', $previous_id) }}"
                        class="btn btn-dark text-uppercase font-weight-bold float-left mb-3">Anterior</a>
                @endif
                @if ($next_id)
                    <a href="{{ route('admin.postulations.view_postulation', $next_id) }}"
                        class="btn btn-dark text-uppercase font-weight-bold float-right mb-3">Siguiente</a>
                @endif
            </div>
        </div>

    </div>
@stop

@section('footer')
    <p class="text-center">Universidad Nacional Santiago Antunez de Mayolo</p>
@stop

@section('css')
    
@stop
