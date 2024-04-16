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
                        <h1 class="text-xl font-medium text-gray-800 ">Postular a la subvención</h1>

                        <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>

                    <form class="mt-5" wire:submit='postulate'>
                        <div>
                            

                            <label for="user name" class="mt-3 block text-gray-700 capitalize">Actividad*:</label>
                            <input placeholder="Nombre de la actividad" type="text" wire:model='name'
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />


                            <label for="user name" class="mt-3 block text-gray-700 capitalize">Tipo*:</label>
                            <select name="" id="" wire:model='activity_id'
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                                <option value="">-- Seleccione --</option>
                                @foreach ($activity_items as $activity)
                                <option value="{{$activity->id}}">{{$activity->name}}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('activity_id')" class="mt-2" />

                            <label for="user name" class="mt-3 block text-gray-700 capitalize">Asesor:</label>
                            <input placeholder="Nombres y apellidos del asesor" type="text" wire:model='adviser'
                                class="block w-full px-3 py-2 mt-2 text-gray-600 placeholder-gray-400 bg-white border border-gray-200 rounded-md focus:border-indigo-400 focus:outline-none focus:ring focus:ring-indigo-300 focus:ring-opacity-40">
                            <x-input-error :messages="$errors->get('adviser')" class="mt-2" />
                        </div>

                        <div class="flex justify-end mt-6">
                            <x-primary-button>POSTULAR</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach ($subsidies as $subsidy)
                <x-postulation.subvention-card
                    title="{{ $subsidy->name }}">
                    <div class="whitespace-pre-wrap mb-2">{{ $subsidy->description }}</div>
                    <button
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        @click="modelOpen =!modelOpen" 
                        wire:click = 'selectSubsidy({{ $subsidy->id }})'
                        >
                        Postular
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </button>
                </x-postulation.subvention-card>
            @endforeach

        </div>
    </div>
</div>
