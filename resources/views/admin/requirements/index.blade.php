@extends('adminlte::page')

@section('title', 'UNASAM')

@section('content_header')
    <h1>REQUISITOS</h1>
@stop

@section('content')
    <div class="card">

        <div class="card-header">
            <a href="{{ route('admin.requirements.create') }}" class="btn btn-primary">Registrar nuevo</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm w-100 my-2" id="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">PESO MAX.</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">DESCRIPCIÓN</th>
                            <th scope="col">ACCIONES</th>
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
                    "data": "max_megabytes",
                    "render": function(data, type, row, meta) {
                        return `${data} MB`;
                    }
                },
                {
                    "data": "name"
                },
                {
                    "data": "description",
                    "render": function(data, type, row, meta) {
                        return data ?? 'Ninguna descripción';
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return (
                            `<div class="d-flex flex-row justify-content-start">
                                <a class="btn btn-primary btn-sm mr-2 btn-edit" href="{{ route('admin.requirements.edit', ':id') }}"><i class="far fa-edit"></i> Editar</a>
                                <button class="btn btn-sm btn-danger btn-delete" type="button"><i class=" fas fa-trash"></i> Eliminar</button>
                            </div>`.replace(':id', data.id)
                        );
                    }
                }
            ];

            columnDefs = [{
                className: 'text-left text-nowrap',
                targets: '_all'
            }];

            let table = $(`#table`).DataTable({
                "ajax": {
                    "url": "{{ route('admin.requirements.data') }}",
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
                            url: "{{route('admin.requirements.destroy')}}",
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
