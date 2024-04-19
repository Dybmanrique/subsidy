<div>
    <div class="card card-primary">
        <div class="card-header font-weight-bold">
            DATOS GENERALES
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td class="text-bold">Nombre actividad:</td>
                        <td>{{ $postulation->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Asesor:</td>
                        <td>{{ $postulation->adviser ?? 'No tiene' }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Correo institucional:</td>
                        <td>{{ $postulation->student->user->email }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Estudiante:</td>
                        <td>{{ $postulation->student->user->last_name }} {{ $postulation->student->user->name }}
                        </td>
                    </tr>
                    <tr>
                        <td class="text-bold">Celular:</td>
                        <td>{{ $postulation->student->phone }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Escuela:</td>
                        <td>{{ $postulation->student->school->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Facultad:</td>
                        <td>{{ $postulation->student->school->faculty->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Estado:</td>
                        <td>{{ $postulation->status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card card-primary">
        <div class="card-header font-weight-bold">
            ACCIONES
        </div>
        <div class="card-body">
            @switch($postulation->status)
                @case('Subiendo archivos')
                    <button type="button" class="btn btn-danger my-1 w-100" onclick="eliminar()"">Eliminar</button>
                @break

                @case('Pendiente de revisión')
                    <button type="button" class="btn btn-success my-1 w-100" onclick="aprobarDII()">Aceptar en la Dirección del
                        Instituto de
                        Investigación</button>
                    <button type="button" class="btn btn-danger my-1 w-100" onclick="denegarDII()">Denegar en la Dirección del
                        Instituto de
                        Investigación</button>
                @break

                @case('Aceptado en la Dirección del Instituto de Investigación')
                    <button type="button" class="btn btn-success my-1 w-100" onclick="aprobarConsejo()">Aprobar en el Consejo
                        Universitario</button>
                    <button type="button" class="btn btn-danger my-1 w-100" onclick="denegarConsejo()">Denegar en el Consejo
                        Universitario</button>
                @break

                @case('Denegado en la Dirección del Instituto de Investigación')
                    <button type="button" class="btn btn-success my-1 w-100" onclick="reafirmar()">Reafirmar</button>
                @break

                @case('Aprobado en el Consejo Universitario')
                @break

                @case('Denegado en el Consejo Universitario')
                @break

                @default
            @endswitch
        </div>
    </div>
    @section('js')
        <script src="{{ asset('js/admin/message_forms.js') }}"></script>
        <script>
            $(document).ready(function() {
                $(".btn-documento").click(function(e) {
                    $("#previsualizador").fadeOut()
                    $("#previsualizador").attr('src', this.dataset.file)
                    $("#previsualizador").fadeIn()
                })
            });

            function aprobarDII() {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "Esta acción no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.aprobarDII();
                    }
                })
            }

            function denegarDII() {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "Esta acción no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.denegarDII();
                    }
                })
            }

            function aprobarConsejo() {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "Esta acción no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.aprobarConsejo();
                    }
                })
            }

            function denegarConsejo() {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "Esta acción no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.denegarConsejo();
                    }
                })
            }

            function reafirmar() {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "Esta acción no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.reafirmar();
                    }
                })
            }
            function eliminar() {
                Swal.fire({
                    title: 'Estas seguro?',
                    text: "Esta acción no se puede revertir!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.eliminar();
                    }
                })
            }
        </script>
    @stop

</div>
