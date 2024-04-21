<div>
    <form wire:submit='save'>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <span class="font-weight-bold">DATOS GENERALES</span>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nombre*:</label>
                                    <input type="text" wire:model='name' id="name" class="form-control"
                                        placeholder="Ingrese el nombre" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <p class="text-bold">Estado*:</p>
                                    <div class="form-group border p-2 mb-1 rounded">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="active_status" wire:model='status'
                                                class="custom-control-input" value="activo" name="statusRadio" required>
                                            <label class="custom-control-label" for="active_status">Activo</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="inactive_status" wire:model='status'
                                                class="custom-control-input" value="inactivo" name="statusRadio">
                                            <label class="custom-control-label" for="inactive_status">Inactivo</label>
                                        </div>
                                    </div>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <span class="font-weight-bold">LISTA DE REQUISITOS</span>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Requisito:</label>
                                    <select name="" id="" class="form-control mb-2"
                                        wire:model='requirement_id'>
                                        <option value="">--Seleccione--</option>
                                        @foreach ($requirements as $requirement)
                                            <option value="{{ $requirement->id }}">{{ $requirement->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('requirement_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <button type="button" class="btn btn-success float-right"
                                        wire:click='addRequirement'>AGREGAR</button>
                                </div>
                                <br>
                                <hr>
                                @forelse ($requirements_list as $id => $requirement)
                                    <div
                                        class="rounded border d-flex flex-row justify-content-between p-2 align-items-center mb-1 overflow-auto">
                                        <span class="text-nowrap">{{ $requirement['name'] }}</span>
                                        <div class="d-flex flex-row flex-sm">
                                            <div class="btn-group-toggle" data-toggle="buttons">
                                                <label
                                                    class="text-nowrap ml-2 btn btn-sm btn-primary font-weight-normal @php echo ($requirement['is_required']) ? 'active' : '' @endphp">
                                                    <input class="check-is-required " type="checkbox"
                                                        data-id='{{ $id }}' checked autocomplete="off">
                                                    {{ $requirement['is_required'] ? 'Obligatorio' : 'No obligatorio' }}
                                                </label>
                                            </div>
                                            <button type="button" data-id='{{ $id }}'
                                                class="btn btn-sm btn-danger btn-delete-requirement ml-2 text-nowrap"><i
                                                    class="fas fa-trash-alt"></i> Eliminar</button>
                                        </div>
                                    </div>
                                @empty
                                    <p class="mb-0 text-center">Aquí aparecerán los requisitos que desee agregar.
                                    </p>
                                @endforelse
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <span class="font-weight-bold">LISTA DE ACTIVIDADES</span>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="form-group">
                                        <label for="">Actividad:</label>
                                        <input type="text" class="form-control mb-2" id="activity_name"
                                            wire:model='activity_name' wire:keydown.enter = 'addActivity' placeholder="Nombre de la actividad">
                                        @error('activity_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <button type="button" class="btn btn-success float-right"
                                            wire:click = 'addActivity'>AGREGAR</button>
                                    </div>
                                    <br>
                                    <hr>
                                    @forelse ($activities_list as $id => $activity)
                                        <div
                                            class="rounded border d-flex flex-row justify-content-between p-2 align-items-center mb-1">
                                            <span>{{ $activity }}</span>
                                            <button type="button" onclick="deleteActivity({{ $id }})"
                                                class="btn btn-sm btn-danger btn-delete-activity"><i
                                                    class="fas fa-trash-alt"></i> Eliminar</button>
                                        </div>
                                    @empty
                                        <p class="mb-0 text-center">Aquí aparecerán las actividades que desee agregar.
                                        </p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> GUARDAR</button>
            </div>
        </div>
    </form>
</div>

@section('js')
    <script src="{{ asset('js/admin/message_forms.js') }}"></script>
    <script>
        activityInput = document.getElementById('activity_name');
        activityInput.addEventListener('keypress', e => {
            if (e.keyCode == 13) {
                e.preventDefault();
            }
        });
        
        $(document).on('click', '.btn-delete-requirement', function() {
            Swal.fire({
                title: '¿Estas seguro?',
                text: "Tendrás que volver a insertar al visitante si lo quitas",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Quitar!',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.deleteRequirement(this.dataset.id)
                }
            })
        });

        $(document).on('change', '.check-is-required', function() {
            @this.changeRequirement(this.dataset.id, this.checked)
        });

        Livewire.on('refresh', function(message) {
            setTimeout(() => {
                location.reload();
            }, 1000);
        })

        function deleteActivity(id) {
            Swal.fire({
                title: '¿Estas seguro?',
                text: "Tendrás que volver a insertar la actividad si la deseas de nuevo",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Quitar!',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.deleteActivity(id)
                }
            })
        }
    </script>
@stop
