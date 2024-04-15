<div>
    <form wire:submit='save'>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
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
                                            <input type="radio" id="active_status" wire:model='status' class="custom-control-input"
                                                value="activo" name="statusRadio" required>
                                            <label class="custom-control-label" for="active_status">Activo</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="inactive_status" wire:model='status' class="custom-control-input"
                                                value="inactivo" name="statusRadio">
                                            <label class="custom-control-label" for="inactive_status">Inactivo</label>
                                        </div>
                                    </div>
                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripción:</label>
                                    <textarea wire:model='description' id="description" rows="6" class="form-control"
                                        placeholder="Ingrese una descripción"></textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Requisitos</label>
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
                                        wire:click='addRequirement'>Agregar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if (count($requirements_list)>0)
                                        
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Requisito</th>
                                                <th scope="col">Obligatorio</th>
                                                <th scope="col">Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($requirements_list as $id => $requirement)
                                                <tr>
                                                    <td>{{ $requirement['name'] }}</td>
                                                    <td>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox"
                                                                class="custom-control-input check-is-required"
                                                                id="customSwitch{{ $id }}"
                                                                data-id='{{ $id }}'
                                                                @php echo ($requirement['is_required']) ? 'checked' : '' @endphp>
                                                            <label class="custom-control-label"
                                                                for="customSwitch{{ $id }}"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" data-id='{{ $id }}'
                                                            class="btn btn-sm btn-danger btn-delete-requirement">x</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <p class="mb-0">Aquí aparecerán los requisitos que desee agregar.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </form>
</div>

@section('js')
    <script src="{{ asset('js/admin/message_forms.js') }}"></script>
    <script>
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
            // Livewire.dispatch('change-requirement', {
            //     id: parseInt(this.dataset.id),
            //     checked: this.checked
            // })
            @this.changeRequirement(this.dataset.id, this.checked)
        });

        Livewire.on('created', function(message) {
            setTimeout(() => {
                location.reload();
            }, 1000);
        })
    </script>
@stop
