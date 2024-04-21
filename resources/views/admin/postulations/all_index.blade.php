@extends('adminlte::page')

@section('title', 'UNASAM')

@section('content_header')
    <h1>TODAS LAS POSTULACIONES</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <p class="mb-0 font-weight-bold">TIPO DE SUBVENCIÓN: <span class="font-weight-normal">{{ $subsidy->name }}</span>
            </p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm w-100 my-2" id="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ACCIONES</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">POSTULANTE</th>
                            <th scope="col">CORREO I.</th>
                            <th scope="col">ESCUELA</th>
                            <th scope="col">FACULTAD</th>
                            <th scope="col">CONVOCATORIA</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('footer')
    <p class="text-center">Universidad Nacional Santiago Antunez de Mayolo</p>
@stop

@section('css')

@stop

@section('js')
    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        $(document).ready(function() {

            let columnAttributes = [{
                    "data": "id",
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return (
                            `<div class="d-flex flex-row justify-content-start">
                                <a class="btn btn-primary btn-sm mr-2 btn-edit text-uppercase font-weight-bold" href="{{ route('admin.postulations.view_postulation', ':id') }}"><i class="far fa-eye"></i> Ver documentos</a>
                            </div>`.replace(':id', data.id)
                        );
                    }
                },
                {
                    "data": "postulation",
                },
                {
                    "data": "status",
                },
                {
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return `${data.last_name} ${data.name}`
                    }
                },
                {
                    "data": "email",
                },
                {
                    "data": "school",
                },
                {
                    "data": "faculty",
                },
                {
                    "data": "announcement",
                },
            ];

            columnDefs = [{
                className: 'text-left text-nowrap',
                targets: '_all'
            }];

            let table = $(`#table`).DataTable({
                "ajax": {
                    "url": "{{ route('admin.postulations.all_data', ':id') }}".replace(':id',
                        {{ $subsidy->id }}),
                    "type": "GET",
                    "dataSrc": "",
                },
                "columns": columnAttributes,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                },
                columnDefs: columnDefs,
                responsive: true
            });
        });
    </script>
@stop
