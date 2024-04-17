<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('LISTA DE SUBVENCIONES DISPONIBLES PARA POSTULAR') }}
        </h2>
    </x-slot>

    @livewire('postulation.subventions-list')

</x-app-layout>
