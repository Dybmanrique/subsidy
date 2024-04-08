<div>
    <div class="card">
        <div class="card-body">
            <form wire:submit='save'>
                <div class="form-group">
                    <label for="name">Nombre*:</label>
                    <input type="text" wire:model='name' id="name" class="form-control"
                        placeholder="Ingrese el nombre" required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="max_megabytes">Peso máximo*:</label>
                    <input type="text" wire:model='max_megabytes' id="max_megabytes" class="form-control"
                        placeholder="Ingrese el peso maximo (en megabytes)" required>
                    @error('max_megabytes')
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

                <button type="submit" class="btn btn-primary float-right">Crear</button>
            </form>
        </div>
    </div>
</div>
