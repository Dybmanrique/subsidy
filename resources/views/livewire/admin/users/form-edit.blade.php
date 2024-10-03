<div class="card">
    <form wire:submit='save'>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email*:</label>
                        <input wire:model='email' type="email" id="email" class="form-control"
                            placeholder="Ingrese el correo electrónico del usuario" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Nombres*:</label>
                        <input wire:model='name' type="text" id="name" class="form-control"
                            placeholder="Ingrese los nombres del usuario" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="last_name">Apellido paterno*:</label>
                        <input wire:model='last_name' type="text" id="last_name" class="form-control"
                            placeholder="Ingrese el apellido parterno del usuario" required>
                        @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="active_status">Estado*:</label>
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
                    <button class="btn btn-info mt-2 mb-2" type="button" data-toggle="collapse"
                        data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Cambiar contraseña <i class="fas fa-key"></i>
                    </button>

                    <div wire:ignore.self class="collapse mt-0" id="collapseExample">
                        <div class="card card-body border shadow-none">
                            <div class="form-group">
                                <label for="password">Password*:</label>
                                <input wire:model='password' type="password" id="password" class="form-control"
                                    placeholder="Ingrese una contraseña">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirmar password*:</label>
                                <input wire:model='password_confirmation' type="password" id="password_confirmation"
                                    class="form-control" placeholder="Repita la contraseña">
                                @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right text-uppercase font-weight-bold"><i
                    class="fas fa-save"></i> Guardar</button>
        </div>
    </form>
</div>
