<div>
    <form wire:submit='save'>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dni">DNI*:</label>
                            <input type="text" wire:model='dni' id="dni" class="form-control"
                                placeholder="Ingrese el nombre" required>
                            @error('dni')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Nombres*:</label>
                            <input type="text" wire:model='name' id="name" class="form-control"
                                placeholder="Ingrese el nombre" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Apellidos*:</label>
                            <input type="text" wire:model='last_name' id="last_name" class="form-control"
                                placeholder="Ingrese el nombre" required>
                            @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Correo Institucional*:</label>
                            <input type="email" wire:model='email' id="email" class="form-control"
                                placeholder="Ingrese el nombre" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Celular*:</label>
                            <input type="text" wire:model='phone' id="phone" class="form-control"
                                placeholder="Ingrese el nombre" required>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="school_id">Escuela*:</label>
                            <select wire:model='school_id' id="school_id" class="form-control">
                                <option value="">--Seleccione--</option>
                                @foreach ($schools as $school)
                                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                                @endforeach
                            </select>
                            @error('school_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="condition">Condición*:</label>
                            <select wire:model='condition' id="condition" class="form-control">
                                <option value="">--Seleccione--</option>
                                <option value="estudiante">Estudiante</option>
                                <option value="egresado">Egresado</option>
                            </select>
                            @error('condition')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <p>
                            <button class="btn btn-success" type="button" data-toggle="collapse"
                                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <i class="fas fa-key"></i> CAMBIAR CONTRASEÑA
                            </button>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">
                                <div class="form-group">
                                    <label for="password">Contraseña*:</label>
                                    <input type="password" wire:model='password' id="password" class="form-control"
                                        placeholder="Ingrese el nombre">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirmar contraseña*:</label>
                                    <input type="password" wire:model='password_confirmation' id="password_confirmation"
                                        class="form-control" placeholder="Ingrese el nombre">
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
                <button type="submit" class="btn btn-primary float-right text-uppercase font-weight-bold"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </form>
</div>
