<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('POR FAVOR SUBA TODOS LOS DOCUMENTOS NECESARIOS') }}
        </h2>
    </x-slot>

    @livewire('postulation.upload-documents', ['postulation' => $postulation])

</x-app-layout>
