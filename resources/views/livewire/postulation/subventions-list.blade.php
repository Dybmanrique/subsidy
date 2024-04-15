<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach ($subsidies as $subsidy)
                <x-postulation.subvention-card
                    img="https://unasam.edu.pe/web/noticiaunasam/noticia-04-04-2023-11-24-23.png"
                    title="{{ $subsidy->name }}">
                    <div class="whitespace-pre-wrap mb-2">{{ $subsidy->description }}</div>
                    <x-primary-button onclick="postulate({{ $subsidy->id }})">
                        Postular
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </x-primary-button>
                </x-postulation.subvention-card>
            @endforeach


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
