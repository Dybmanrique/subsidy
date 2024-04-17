<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="m-4">
                        <x-application-logo class="block h-15 w-auto fill-current text-gray-700" />
                    </div>

                    <div class="md:flex" x-data="{ openTab: 0 }">
                        <ul
                            class="flex-column space-y space-y-0 text-sm font-medium text-gray-500 md:me-4 mb-4 md:mb-0">
                            @foreach ($postulation->requirements as $index => $requirement)
                                <li>
                                    <button type="button"
                                        class="shadow border text-nowrap inline-flex items-center px-4 py-3 mb-1 rounded-lg bg-gray-50 hover:text-gray-100 hover:bg-blue-700 w-full"
                                        x-on:click="openTab = {{ $index }}"
                                        :class="{ 'bg-blue-700 text-white': openTab === {{ $index }} }">
                                        Requisito {{ $index + 1 }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        @foreach ($postulation->requirements as $index => $requirement)
                            <div x-show="openTab === {{ $index }}"
                                class="border shadow transition-all duration-300 p-6 bg-gray-50 text-medium text-gray-500  rounded-lg w-full">
                                <h3 class="text-lg font-bold text-gray-900  mb-2">{{ $requirement->name }}</h3>
                                <p class="mb-2">{{ $requirement->description }}</p>

                                <iframe src="{{ Storage::url($requirement->pivot->file) }}"
                                    {{-- src="https://docs.google.com/viewer?url=https://www.infor.uva.es/~felix/datos/tprg/tr_holamundo.pdf&embedded=true" --}} frameborder="0" class="w-full rounded"
                                    style="height: 25em"></iframe>

                                <div>
                                    @if ($index > 0)
                                        <x-primary-button class="mt-2"
                                            x-on:click="openTab = {{ $index - 1 }}">Anterior</x-primary-button>
                                    @endif
                                    @if ($index < count($postulation->requirements) - 1)
                                        <x-primary-button class="mt-2 float-right"
                                            x-on:click="openTab = {{ $index + 1 }}">Siguiente</x-primary-button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
