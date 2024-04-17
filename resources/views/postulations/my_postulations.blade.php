<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('LISTA DE MIS POSTULACIONES') }}
        </h2>
    </x-slot>

    @livewire('postulation.my-postulations')

</x-app-layout>
