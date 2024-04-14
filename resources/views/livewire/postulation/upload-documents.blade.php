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
                                            <input wire:model = 'file_modal'
                                                class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 focus:shadow-te-primary focus:outline-none"
                                                type="file" />
                                            <x-input-error :messages="$errors->get('file_modal')" class="mt-2" />
                                        </div>

                                        <div class="flex justify-end mt-6">
                                            <x-primary-button>Aceptar</x-primary-button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="md:flex" x-data="{ openTab: 0 }">
                        <ul
                            class="flex-column space-y space-y-0 text-sm font-medium text-gray-500 md:me-4 mb-4 md:mb-0">
                            @foreach ($requirements as $index => $requirement)
                                <li>
                                    <a href="#"
                                        class="inline-flex items-center px-4 py-3 mb-1 rounded-lg bg-gray-50 hover:text-gray-100 hover:bg-blue-700 w-full"
                                        x-on:click="openTab = {{ $index }}"
                                        :class="{ 'bg-blue-700 text-white': openTab === {{ $index }} }">
                                        {{ $requirement->name }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                        @foreach ($requirements as $index => $requirement)
                            <div x-show="openTab === {{ $index }}"
                                class="transition-all duration-300 p-6 bg-gray-50 text-medium text-gray-500  rounded-lg w-full">
                                <h3 class="text-lg font-bold text-gray-900  mb-2">{{ $requirement->name }}</h3>
                                <p class="mb-2">{{ $requirement->description }}</p>
                                <x-primary-button class="mb-2" @click="modelOpen =!modelOpen"
                                    wire:click='setRequirementModal({{ $requirement->id }})'>Subir
                                    documento</x-primary-button>

                                @if ($file_requirement = $postulation->requirements()->where('requirement_id', $requirement->id)->first())
                                    <iframe src="{{ Storage::url($file_requirement->pivot->file) }}"
                                        {{-- src="https://docs.google.com/viewer?url=https://www.infor.uva.es/~felix/datos/tprg/tr_holamundo.pdf&embedded=true" --}} frameborder="0" class="w-full rounded"
                                        style="height: 25em"></iframe>
                                @else
                                    <div class="rounded border py-4">
                                        <p class="text-center">Todavía no hay archivos aqui</p>
                                    </div>
                                @endif


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
            
        </script>
    @endpush
</div>
