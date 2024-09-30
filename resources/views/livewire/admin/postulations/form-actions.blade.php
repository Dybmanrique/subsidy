<div>
    <!-- Modal change state -->
    <div class="modal fade" id="addStateModal" tabindex="-1" role="dialog" aria-labelledby="addStateModalTitle"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form wire:submit='addState()'>
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">AGREGAR CAMBIO DE ESTADO
                        </h5>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="state_id" class="font-weight-normal">Cambio*:</label>
                            <select id="state_id" wire:model='state_id' class="form-control">
                                <option value="">-- Seleccione --</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>
                            @error('state_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description" class="font-weight-normal">Descripcion:</label>
                            <textarea id="description" wire:model='description' rows="6" class="form-control"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" id="is_sendable" wire:model='is_sendable'
                                    value="option1">
                                <label for="is_sendable" class="custom-control-label font-weight-normal">Enviar un
                                    correo electrónico también</label>
                            </div>
                            @error('is_sendable')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger text-uppercase font-weight-bold"
                            data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary text-uppercase font-weight-bold">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal message -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="messageModalTitle"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form wire:submit='sendMessage'>
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">ENVIAR MENSAJE</h5>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title" class="font-weight-normal">ASUNTO*:</label>
                            <input type="text" wire:model="title" id="title" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="message" class="font-weight-normal">Indique el motivo o la razón de la
                                negación*:</label>
                            <textarea id="message" wire:model='message' rows="6" class="form-control"></textarea>
                            @error('message')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger text-uppercase font-weight-bold"
                            data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary text-uppercase font-weight-bold">Aceptar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header font-weight-bold">
            DATOS GENERALES
        </div>
        <div class="card-body">
            <table class="table table-sm table-responsive">
                <tbody>
                    <tr>
                        <td class="text-bold">Nombre actividad:</td>
                        <td>{{ $postulation->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-bold">Convocatoria:</td>
                        <td>{{ $postulation->announcement->name }}</td>
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
                        <td class="text-bold">Último estado:</td>
                        <td>{{ $postulation->states()->orderBy('postulation_state.created_at', 'desc')->first()->name }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card card-primary">
        <div class="card-header font-weight-bold">
            <div class="d-flex justify-content-between align-items-center">
                <span>
                    ACCIONES
                </span>
            </div>
        </div>
        <div class="card-body">
            <button class="btn btn-dark w-100 font-weight-bold text-uppercase" data-toggle="modal"
                data-target="#addStateModal">
                <i class="fas fa-exchange-alt"></i> Agregar cambio
            </button>
            <button class="btn btn-info w-100 font-weight-bold text-uppercase my-1" data-toggle="modal"
                data-target="#messageModal">
                <i class="fas fa-envelope"></i> Enviar
                mensaje
            </button>
            <button type="button" class="btn btn-danger font-weight-bold text-uppercase w-100"
                onclick="eliminar()""><i class="fas fa-trash"></i> Eliminar postulación</button>
        </div>
    </div>
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
                                        <span class="time text-sm text-muted text-nowrap"><i
                                                class="fas fa-calendar"></i>
                                            {{ $state->created_at->format('d-m-Y') }}</span>
                                        <span class="time text-sm text-muted text-nowrap"><i class="fas fa-clock"></i>
                                            {{ $state->created_at->format('h:i A') }}</span>
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

@push('js')
    <script src="{{ asset('js/admin/message_forms.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".btn-documento").click(function(e) {
                $("#previsualizador").fadeOut()
                $('#previsualizador').attr('src', this.dataset.file);
                $("#previsualizador").fadeIn()
            })
        });

        Livewire.on('close_modal', function(message) {
            $('#messageModal').modal('hide')
        })
        Livewire.on('close_modal_change', function(message) {
            $('#addStateModal').modal('hide')
        })

        function eliminar() {
            Swal.fire({
                title: '¿Estas seguro?',
                text: "Esta acción puede tener consecuencias!",
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
@endpush
