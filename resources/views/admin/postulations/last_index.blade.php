@extends('adminlte::page')

@section('title', 'UNASAM')

@section('content_header')
    <h1 class="font-weight-bold">POSTULACIONES DE LA ÚLTIMA CONVOCATORIA</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <p class="mb-0 font-weight-bold">TIPO DE SUBVENCIÓN: <span class="font-weight-normal">{{ $subsidy->name }}</span></p>
            <p class="mb-0 font-weight-bold">ÚLTIMA CONVOCATORIA: <span class="font-weight-normal">{{ $last_announcement->name }}</span></p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm w-100 my-2" id="table">
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ACCIONES</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">ACTIVIDAD</th>
                            <th scope="col">INTEGRANTES</th>
                            <th scope="col">REPRESENTANTE</th>
                            <th scope="col">ESCUELA</th>
                            <th scope="col">FACULTAD</th>
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
<style>
    tfoot {
        display: table-header-group;
    }
</style>
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
                    "data": "state",
                },
                {
                    "data": "activity",
                },
                {
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return `${data.student_members + data.graduated_members} (E:${data.student_members}; G:${data.graduated_members}) `
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return `${data.last_name} ${data.name}`
                    }
                },
                {
                    "data": "school",
                },
                {
                    "data": "faculty",
                },
            ];

            columnDefs = [{
                className: 'text-left text-nowrap',
                targets: '_all'
            }];

            let table = $(`#table`).DataTable({
                "ajax": {
                    "url": "{{ route('admin.postulations.last_data', ':id') }}".replace(':id',
                        {{ $subsidy->id }}),
                    "type": "GET",
                    "dataSrc": "",
                },
                "columns": columnAttributes,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                },
                columnDefs: columnDefs,
                buttons: [{
                        extend: 'copy',
                        footer: false,
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'excel',
                        footer: false,
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'print',
                        footer: false,
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                ],
                layout: {
                    topEnd: 'buttons'
                },
                initComplete: function() {
                    this.api()
                        .columns([2, 6,])
                        .every(function() {
                            let column = this;
                            let title = column.footer().textContent;

                            // Create input element
                            let input = document.createElement('input');
                            input.classList.add('form-control')
                            input.placeholder = title;
                            column.footer().replaceChildren(input);

                            // Event listener for user input
                            input.addEventListener('keyup', () => {
                                if (column.search() !== this.value) {
                                    column.search(input.value).draw();
                                }
                            });
                        });

                    this.api()
                        .columns([3, 4, 7, 8])
                        .every(function() {
                            let column = this;

                            // Create select element
                            let select = document.createElement('select');
                            select.add(new Option(''));
                            select.classList.add('form-control')
                            column.footer().replaceChildren(select);

                            // Apply listener for user change in value
                            select.addEventListener('change', function() {
                                column
                                    .search(select.value, {
                                        exact: true
                                    })
                                    .draw();
                            });

                            // Add list of options
                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.add(new Option(d));
                                });
                        });
                }
            });
        });
    </script>
@stop
