<div>
    <form wire:submit='save'>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nombre de la facultad*:</label>
                    <input type="text" wire:model='name' id="name" class="form-control"
                        placeholder="Ingrese el nombre" required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right font-weight-bold text-uppercase"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </form>
</div>
