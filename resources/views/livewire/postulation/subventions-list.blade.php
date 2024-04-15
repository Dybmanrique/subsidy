<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach ($subsidies as $subsidy)
                    <x-postulation.subvention-card
                        img="https://unasam.edu.pe/web/noticiaunasam/noticia-04-04-2023-11-24-23.png"
                        title="{{ $subsidy->name }}">
                        <span class="whitespace-pre-wrap">{{ $subsidy->description }}</span>
                        <div class="flex justify-end items-end h-full mt-2">
                            <x-primary-button onclick="postulate({{ $subsidy->id }})">Postular</x-primary-button>
                        </div>
                    </x-postulation.subvention-card>
                @endforeach
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/admin/message_forms.js') }}"></script>
        <script>
            function postulate(id) {
                Swal.fire({
                    title: '¿Esta seguro?',
                    html: "<p><span class='font-bold'>IMPORTANTE:</span> Recuerde que se puede postular sólo a UNA subvención por año. Si tiene dudas puede leer el REGLAMENTO</p><br><p class='text-left font-bold'>Nombre de la actividad:<p>",
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off',
                        style: ' border-radius: 5px;'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'POSTULAR',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'CANCELAR',
                    showLoaderOnConfirm: true,
                    preConfirm: (name) => {
                        if (!name) {
                            Swal.showValidationMessage('Por favor ingresa el nombre de la actividad');
                            return name;
                        }
                        @this.postulate(id, name)
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                });
            }
        </script>
    @endpush
</div>
