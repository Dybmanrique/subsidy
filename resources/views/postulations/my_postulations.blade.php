<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis postulaciones') }}
        </h2>
    </x-slot>

    @livewire('postulation.my-postulations')

</x-app-layout>
