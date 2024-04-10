<div>
    <form wire:submit='save'>
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
                    <label for="faculty_id">Facultad*:</label>
                    <select wire:model='faculty_id' id="faculty_id" class="form-control">
                        <option value="">--Seleccione--</option>
                        @foreach ($faculties as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                        @endforeach
                    </select>
                    @error('faculty_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Crear</button>
            </div>
        </div>
    </form>
</div>
