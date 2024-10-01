@extends('adminlte::page')

@section('title', 'UNASAM')

@section('content_header')
    <h1 class="font-weight-bold">ESTUDIANTES</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-header">
            <a href="{{ route('admin.students.create') }}" class="btn btn-primary font-weight-bold text-uppercase">Registrar nuevo estudiante</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm w-100 my-2" id="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">DNI</th>
                            <th scope="col">ESTUDIANTE</th>
                            <th scope="col">CORREO</th>
                            <th scope="col">CELULAR</th>
                            <th scope="col">CONDICIÓN</th>
                            <th scope="col">ESCUELA</th>
                            <th scope="col">FACULTAD</th>
                            <th scope="col">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer"></div>
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
                    "data": "dni"
                },
                {
                    "data": "user.name"
                },
                {
                    "data": "user.email"
                },
                {
                    "data": "phone"
                },
                {
                    "data": "condition",
                    "render": function(data, type, row, meta) {
                        return data.charAt(0).toUpperCase() + data.slice(1);
                    }
                },
                {
                    "data": "school.name"
                },
                {
                    "data": "school.faculty.name"
                },
                {
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return (
                            `<div class="d-flex flex-row justify-content-end">
                                <a class="btn btn-primary btn-sm mr-2 font-weight-bold text-uppercase btn-edit" href="{{ route('admin.students.edit', ':id') }}"><i class="far fa-edit"></i> Editar</a>
                                <button class="btn btn-sm btn-danger font-weight-bold text-uppercase btn-delete" type="button"><i class=" fas fa-trash"></i> Eliminar</button>
                            </div>`.replace(':id', data.id)
                        );
                    }
                }
            ];

            columnDefs = [{
                className: 'text-left text-nowrap',
                targets: [0,1,2,3,4,5,6,7]
            },{
                className: 'text-right',
                targets: [8]
            }];

            let table = $(`#table`).DataTable({
                "ajax": {
                    "url": "{{ route('admin.students.data') }}",
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
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'excel',
                        footer: false,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'print',
                        footer: false,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                ],
                layout: {
                    topStart: 'buttons'
                },
            });

            $(`#table tbody`).on('click', '.btn-delete', function() {
                let data = table.row($(this).parents('tr')).data();
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "Esta acción no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar!',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{route('admin.students.destroy')}}",
                            type: "POST",
                            dataType: 'json',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                id: data["id"],
                            }
                        }).done(function(response) {
                            if (response.code == '200') {
                                table.ajax.reload();
                                Toast.fire({
                                    icon: 'success',
                                    title: response.message
                                });
                            } else if (response.code == '500') {
                                Toast.fire({
                                    icon: 'info',
                                    title: response.message
                                });
                            }
                        });
                    }
                })
            });

        });
    </script>
@stop
