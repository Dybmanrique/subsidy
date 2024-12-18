<div>
    {{-- @foreach ($postulation->announcement->subsidy->requirements as $requirement)
        <p>{{$requirement->name}}</p>
    @endforeach --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900" x-data="{ modelOpen: $wire.entangle('model_open') }">

                    <div>
                        {{-- <button @click="modelOpen =!modelOpen" class="flex items-center justify-center px-3 py-2 space-x-2 text-sm tracking-wide text-white capitalize transition-colors duration-200 transform bg-indigo-500 rounded-md dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:bg-indigo-700 hover:bg-indigo-600 focus:outline-none focus:bg-indigo-500 focus:ring focus:ring-indigo-300 focus:ring-opacity-50">
                            <span>Invite Member</span>
                        </button> --}}

                        <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
                            role="dialog" aria-modal="true">
                            <div
                                class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                                <div x-cloak @click="modelOpen = false" x-show="modelOpen"
                                    x-transition:enter="transition ease-out duration-300 transform"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200 transform"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
                                    aria-hidden="true"></div>

                                <div x-cloak x-show="modelOpen"
                                    x-transition:enter="transition ease-out duration-300 transform"
                                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave="transition ease-in duration-200 transform"
                                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                    class="inline-block w-full max-w-xl p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl">
                                    <div class="flex items-center justify-between space-x-4">
                                        <h1 class="text-xl font-medium text-gray-800 ">Subir documento</h1>

                                        <button @click="modelOpen = false"
                                            class="text-gray-600 focus:outline-none hover:text-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>
                                    </div>

                                    <form class="mt-5"wire:submit='uploadFile'>
                                        <div>
                                            {{-- <label for="user name" class="block text-sm text-gray-700 capitalize">Teammate name</label> --}}
                                            <input wire:model = 'file_modal' accept=".pdf"
                                                class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none"
                                                type="file" />
                                            <x-input-error :messages="$errors->get('file_modal')" class="mt-2" />
                                        </div>

                                        {{-- <div class="flex justify-end mt-6">
                                            <x-primary-button>Aceptar</x-primary-button>
                                        </div> --}}
                                        <div class="flex justify-between mt-4">
                                            <div wire:target='uploadFile' wire:loading.remove>
                                                <button type="submit" wire:target='file_modal' wire:loading.attr="disabled" wire:loading.class="opacity-20 cursor-wait"
                                                    class="inline-flex items-center px-4 py-2 bg-blue-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Aceptar</button>
                                            </div>
                                            <div wire:loading.flex wire:target='uploadFile' class="flex items-center justify-end">
                                                <div role="status">
                                                    <svg aria-hidden="true"
                                                        class="w-4 h-4 me-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                            fill="currentFill" />
                                                    </svg>
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                Subiendo el documento...
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:flex" x-data="{ openTab: -1 }">
                        <ul
                            class="flex-column space-y space-y-0 text-sm font-medium text-gray-500 md:me-4 mb-4 md:mb-0">
                            <li>
                                <button
                                    class="border shadow text-nowrap inline-flex items-center px-4 py-3 mb-1 rounded-lg hover:text-gray-100 hover:bg-blue-700 w-full"
                                    x-on:click="openTab = {{ -1 }}"
                                    :class="{ 'bg-blue-700 text-white': openTab === {{ -1 }} }">
                                    General
                                </button>
                            </li>
                            @foreach ($requirements as $index => $requirement)
                                <li>
                                    <button
                                        class="border shadow text-nowrap inline-flex items-center px-4 py-3 mb-1 rounded-lg hover:text-gray-100 hover:bg-blue-700 w-full"
                                        x-on:click="openTab = {{ $index }}"
                                        :class="{ 'bg-blue-700 text-white': openTab === {{ $index }} }">
                                        Requisito {{ $index + 1 }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        <div x-show="openTab === -1"
                            class="border shadow transition-all duration-300 p-6 bg-gray-50 text-medium text-gray-500  rounded-lg w-full">
                            <h3 class="text-lg font-bold text-gray-900  mb-2">DATOS GENERALES</h3>

                            <form class="mt-5" wire:submit='updateGeneralData'>
                                <div>
                                    <label for="name"
                                        class="mt-3 block text-gray-700 capitalize">Actividad*:</label>
                                    <input id="name" placeholder="Nombre de la actividad" type="text" wire:model='name'
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />


                                    <label for="activity_id" class="mt-3 block text-gray-700 capitalize">Tipo*:</label>
                                    <select id="activity_id" wire:model='activity_id'
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                        <option value="">-- Seleccione --</option>
                                        @foreach ($activity_items as $activity)
                                            <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('activity_id')" class="mt-2" />

                                    <label for="student_members" class="mt-3 block text-gray-700 capitalize">N° de postulantes estudiantes*:</label>
                                    <input id="student_members" placeholder="Cantidad de postulantes estudiantes" type="number"
                                        wire:model='student_members'
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                    <x-input-error :messages="$errors->get('student_members')" class="mt-2" />
                                    
                                    <label for="graduated_members" class="mt-3 block text-gray-700 capitalize">N° de postulantes egresados*:</label>
                                    <input id="graduated_members" placeholder="Cantidad de postulantes egresados" type="number"
                                        wire:model='graduated_members'
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                    <x-input-error :messages="$errors->get('graduated_members')" class="mt-2" />
                                    
                                    <label for="budget" class="mt-3 block text-gray-700 capitalize">Presupuesto*:</label>
                                    <input id="budget" placeholder="Cantidad de presupuesto - S/." type="number" step="0.01"
                                        wire:model='budget'
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                    <x-input-error :messages="$errors->get('budget')" class="mt-2" />
                                    
                                    <label for="adviser" class="mt-3 block text-gray-700 capitalize">Asesor:</label>
                                    <input id="adviser" placeholder="Nombres y apellidos del asesor" type="text"
                                        wire:model='adviser'
                                        class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                    <x-input-error :messages="$errors->get('adviser')" class="mt-2" />
                                </div>

                                <div class="flex justify-center mt-6">
                                    <x-primary-button>Actualizar datos</x-primary-button>
                                </div>
                            </form>

                            <div>
                                <x-dark-button class="mt-2 float-right"
                                    x-on:click="openTab = 0">Siguiente</x-dark-button>
                            </div>
                        </div>
                        @foreach ($subsidy->requirements as $index => $requirement)
                            <div x-show="openTab === {{ $index }}"
                                class="border shadow transition-all duration-300 p-6 bg-gray-50 text-medium text-gray-500  rounded-lg w-full">
                                <h3 class="text-lg font-bold text-gray-900  mb-2">{{ $requirement->name }} ({{ $requirement->pivot->is_required === 1 ? 'Obligatorio' : 'Opcional' }})</h3>
                                <p class="mb-2">{{ $requirement->description }} (Peso máximo: {{ $requirement->max_megabytes }}Mb)</p>

                                @php
                                    $file_requirement = $postulation->requirements()->where('requirement_id', $requirement->id)->first();
                                @endphp

                                <div class="flex justify-between">
                                    <x-primary-button class="mb-2" @click="modelOpen =!modelOpen"
                                        wire:click='setRequirementModal({{ $requirement->id }})'>Subir
                                        documento</x-primary-button>
                                        @if ($file_requirement)
                                        <x-danger-button class="mb-2"
                                            onclick="deleteFile({{ $requirement->id }})">Eliminar</x-danger-button>
                                        @endif
                                </div>

                                @if ($file_requirement)
                                    <iframe
                                        wire:key='{{$requirement->id}}'
                                        src="{{ Storage::url($file_requirement->pivot->file) }}"
                                        {{-- src="https://docs.google.com/viewer?url=https://www.infor.uva.es/~felix/datos/tprg/tr_holamundo.pdf&embedded=true" --}}
                                        frameborder="0" class="w-full rounded"
                                        style="height: 25em"></iframe>
                                @else
                                    <div class="rounded border py-4">
                                        <p class="text-center">Todavía no hay archivos aqui</p>
                                    </div>
                                @endif

                                <div>
                                    @if ($index > 0)
                                    @endif
                                    <x-dark-button class="mt-2"
                                        x-on:click="openTab = {{ $index - 1 }}">Anterior</x-dark-button>
                                    @if ($index < count($requirements) - 1)
                                        <x-dark-button class="mt-2 float-right"
                                            x-on:click="openTab = {{ $index + 1 }}">Siguiente</x-dark-button>
                                    @endif
                                    @if ($index >= count($requirements) - 1)
                                        <x-success-button class="mt-2 float-right"
                                            onclick="confirmRequirements()">Confirmar documentos</x-success-button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/admin/message_forms.js') }}"></script>
        <script>
            function deleteFile(id) {
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "Tendrás que subir otro documento en caso sea obligatorio",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.deleteFile(id)
                    }
                })
            }

            function confirmRequirements() {
                Swal.fire({
                    title: '¿Estas seguro?',
                    text: "Al confirmar ya no podrás editar tus documentos",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Confirmar',
                    cancelButtonText: 'No'
                }).then((result) => {
                    if (result.isConfirmed) {
                        @this.confirmRequirements()
                    }
                })
            }
        </script>
    @endpush
</div>
