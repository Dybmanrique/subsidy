@extends('adminlte::page')

@section('title', 'UNASAM')

@section('content_header')
    <h1 class="font-weight-bold">REPORTES</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    REPORTE GENERAL
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.reports.general') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="activity_id">Actividad:</label>
                            <select name="activity_id" id="activity_id" class="form-control">
                                <option>-- Seleccione --</option>
                                @foreach ($activities as $activity)
                                    <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="year">Año:</label>
                            <input type="text" id="year" name="year" class="datepicker form-control"/>
                        </div>
                        <button class="btn btn-primary" type="submit">Generar</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    REPORTE DE FACULTADES
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.reports.by_faculty') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="activity_id">Actividad:</label>
                            <select name="activity_id" id="activity_id" class="form-control">
                                <option>-- Seleccione --</option>
                                @foreach ($activities as $activity)
                                    <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="year">Año:</label>
                            <input type="text" id="year" name="year" class="datepicker form-control"/>
                        </div>
                        <button class="btn btn-primary" type="submit">Generar</button>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    REPORTE HISTÓRICO
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.reports.historical') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="year">Año:</label>
                            <input type="text" id="year" name="year" class="datepicker form-control"/>
                        </div>
                        <button class="btn btn-primary" type="submit">Generar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <script>
        $(".datepicker").datepicker({
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });
    </script>
@stop
