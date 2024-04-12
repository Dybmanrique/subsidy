<div>
    <div class="p-6 lg:p-8 bg-white border-b border-gray-200 grid grid-cols-5 gap-4">
        <div class="col-span-1">
            <img class="img-fluid rounded" src="{{$img}}"
                alt="Imagen de subvención">
        </div>
        <div class="col-span-4">
            <h2 class="text-1xl font-medium text-gray-900">
                {{$title}}
            </h2>
            <div class="mt-4 text-gray-500 leading-relaxed">
                {{ $slot }}
            </div>
        </div>
    </div>    
</div>