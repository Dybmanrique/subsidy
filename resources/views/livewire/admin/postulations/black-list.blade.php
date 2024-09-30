<div class="font-weight-normal text-dark">
    <button class="btn btn-dark btn-sm font-weight-bold text-uppercase" data-toggle="modal" data-target="#darkListModal">
        <i class="fas fa-list-alt"></i> Abrir lista negra
    </button>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="darkListModal" role="dialog" aria-labelledby="darkListModalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title font-weight-bold text-uppercase" id="exampleModalLongTitle">lista negra</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-light">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="black_list_id">Buscar:</label>
                        <div wire:ignore>
                            <select id="black_list_id" class="form-control"
                                data-placeholder="Buscar correo en lista negra">
                                <option></option>
                                @foreach ($black_list as $item)
                                    <option value="{{ $item->id }}">{{ $item->email }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($reason_item_selected)
                        <div class="form-group">
                            <p class="font-weight-bold">Motivo: <span
                                    class="font-weight-normal">{{ $reason_item_selected }}</span></p>
                        </div>
                    @endif
                    <hr>
                    <button class="btn btn-primary font-weight-bold text-uppercase" type="button"
                        data-toggle="collapse" data-target="#collapseExample" aria-expanded="false"
                        aria-controls="collapseExample">
                        Agregar a la lista
                    </button>
                    <div class="collapse" id="collapseExample" wire:ignore.self>
                        <div class="card card-body">
                            <form wire:submit="save">
                                <div class="form-group">
                                    <label for="email">Correo institucional*:</label>
                                    <input type="text" wire:model="email" id="email" class="form-control">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="reason">Motivo*:</label>
                                    <textarea wire:model="reason" id="reason" rows="4" class="form-control"></textarea>
                                    @error('reason')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="btn btn-dark font-weight-bold text-uppercase">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $('#black_list_id').select2({
            theme: 'bootstrap-5',
        }).on('select2:select', function(e) {
            @this.set('id_item_selected', $('#black_list_id').select2("val"));
            @this.show_reason();
        });

        Livewire.on('email_saved', function(message) {
            var newOption = new Option(`${message.email}`, message.id);
            $('#black_list_id').append(newOption).trigger('change');
            $('#black_list_id').val(message.id).trigger('change.select2');
            @this.set('id_item_selected', message.id);
            @this.show_reason();
        })
    </script>
@endpush
