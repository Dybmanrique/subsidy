<div x-data="{ modelOpen: $wire.entangle('model_open') }">
    <div>
        <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                    x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

                <div x-cloak x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="transition ease-in duration-200 transform"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800 ">Generar solicitud</h1>

                        <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>

                    <form class="mt-5" wire:submit='generateSolicitude()'>
                        <div>
                            <label for="user name" class="mt-3 block text-gray-700">Si desea puede agregar una imagen de
                                su firma:</label>
                            <input wire:model = 'file_modal' accept="image/*"
                                class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none"
                                type="file" />
                            <x-input-error :messages="$errors->get('file_modal')" class="mt-2" />
                        </div>

                        <div class="flex justify-end mt-6">
                            <x-primary-button>GENERAR</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach ($postulations as $postulation)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg m-2 rounded">
                    <div class="p-6 text-gray-900 md:flex md:flex-row">
                        <div class="flex-1">
                            <p><span class="font-bold">Nombre: </span>{{ $postulation->name ?? 'Sin nombre' }}</p>
                            <p><span class="font-bold">Asesor: </span>{{ $postulation->adviser ?? 'Sin asesor' }}</p>
                            <p><span class="font-bold">Convocatoria: </span>{{ $postulation->announcement->name }}</p>
                            <p><span class="font-bold">Tipo de subvención:
                                </span>{{ $postulation->announcement->subsidy->name }}</p>
                            <div class="mt-2">
                                @if (
                                    $postulation->editable_up_to !== null && $postulation->editable_up_to > now())
                                    <x-primary-link
                                        href="{{ route('postulations.postulate', $postulation) }}">Editar</x-primary-link>
                                @endif

                                <button
                                    class="mb-1 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    wire:click = 'setPostulationId({{ $postulation->id }})'
                                    @click="modelOpen =!modelOpen">Generar solicitud</button>
                                <x-success-link class="mb-1"
                                    href="{{ route('postulations.view_documents', $postulation) }}" target="_blank">Ver
                                    documentos</x-success-link>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-lg border-t-2 md:border-none mt-2 md:mt-0">Historial:</h3>
                            <ol class="relative border-s border-gray-700">
                                @foreach ($postulation->states as $state)
                                    <li class="mb-4 ms-4">
                                        <div
                                            class="absolute w-3 h-3 bg-gray-700 rounded-full mt-1.5 -start-1.5 border border-white">
                                        </div>
                                        <h3 class=" font-semibold text-gray-900">{{ $state->name }}</h3>
                                        <time
                                            class="mb-1 text-sm font-normal leading-none text-gray-500">{{ $state->pivot->created_at->diffForHumans() }}</time>
                                        <p class="mb-4 text-base font-normal text-gray-500">{{$state->pivot->description}}</p>
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
