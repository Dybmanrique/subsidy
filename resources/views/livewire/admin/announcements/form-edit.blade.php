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
                    <label for="start">Inicio*:</label>
                    <input type="date" wire:model='start' id="start" class="form-control"
                        placeholder="Ingrese el nombre" required>
                    @error('start')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="end">Fin*:</label>
                    <input type="date" wire:model='end' id="end" class="form-control"
                        placeholder="Ingrese el nombre" required>
                    @error('end')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="subsidy_id">Tipo de subvencion*:</label>
                    <select wire:model='subsidy_id' id="subsidy_id" class="form-control">
                        <option value="">--Seleccione--</option>
                        @foreach ($subsidies as $subsidy)
                            <option value="{{ $subsidy->id }}">{{ $subsidy->name }}</option>
                        @endforeach
                    </select>
                    @error('subsidy_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="vicerrector_id">Vicerrector*:</label>
                    <select wire:model='vicerrector_id' id="vicerrector_id" class="form-control">
                        <option value="">--Seleccione--</option>
                        @foreach ($vicerrectors as $vicerrector)
                            <option value="{{ $vicerrector->id }}">{{ $vicerrector->last_name }} {{ $vicerrector->name }}</option>
                        @endforeach
                    </select>
                    @error('vicerrector_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Descripción:</label>
                    <textarea wire:model='description' id="description" class="form-control" placeholder="Ingrese una descripción"
                        rows="4"></textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right">Editar</button>
            </div>
        </div>
    </form>
</div>
