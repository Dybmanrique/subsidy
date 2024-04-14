<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subir documentos') }}
        </h2>
    </x-slot>

    @livewire('postulation.upload-documents', ['postulation' => $postulation])

</x-app-layout>
