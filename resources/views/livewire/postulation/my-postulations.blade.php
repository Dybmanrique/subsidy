<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach ($postulations as $postulation)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-2">
                    <div class="p-6 text-gray-900">
                        <p><span class="font-bold">Nombre: </span>{{$postulation->name ?? 'Sin nombre'}}</p>
                        <p><span class="font-bold">Asesor: </span>{{$postulation->adviser ?? 'Sin asesor'}}</p>
                        <p><span class="font-bold">Estado: </span>{{$postulation->status}}</p>
                        <p><span class="font-bold">Convocatoria: </span>{{$postulation->announcement->name}}</p>
                        <p><span class="font-bold">Tipo de subvención: </span>{{$postulation->announcement->subsidy->name}}</p>
                        <div class="mt-2">
                            <x-primary-link href="{{route('postulations.postulate', $postulation->id)}}">Editar</x-primary-link>
                            <x-primary-button>Generar Solicitud</x-primary-button>
                            <x-primary-button>Ver documentos</x-primary-button>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>
