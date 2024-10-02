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
                        <button class="btn btn-primary" type="submit">Generar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')

@stop
