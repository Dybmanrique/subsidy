<div>
    <div class="card">
        <form wire:submit='save'>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="limit_postulations">Límite de postulaciones por año:</label>
                            <input type="number" id="limit_postulations" wire:model='limit_postulations'
                                class="form-control" autocomplete="off">
                            @error('limit_postulations')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subsidy_link">Link de las subvenciones:</label>
                            <input type="text" id="subsidy_link" wire:model='subsidy_link' class="form-control"
                                autocomplete="off">
                            @error('subsidy_link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="regulation_link">Link del reglamento:</label>
                            <input type="text" id="regulation_link" wire:model='regulation_link' class="form-control"
                                autocomplete="off">
                            @error('regulation_link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cover_image">Link de imagen de fondo:</label>
                            <input type="text" id="cover_image" wire:model='cover_image' class="form-control"
                                autocomplete="off">
                            @error('cover_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="unasam_link">Link de la UNASAM:</label>
                            <input type="text" id="unasam_link" wire:model='unasam_link' class="form-control"
                                autocomplete="off">
                            @error('unasam_link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="vicerrectorate_link">Link del Vicerrectorado de Investigación:</label>
                            <input type="text" id="vicerrectorate_link" wire:model='vicerrectorate_link'
                                class="form-control" autocomplete="off">
                            @error('vicerrectorate_link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
</div>
