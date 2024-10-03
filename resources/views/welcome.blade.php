<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <main>
                
                <div class="bg-gray-50 text-black/50 ">
                    {{-- <img id="background" class="absolute -left-20 top-0 max-w-[877px]" src="https://laravel.com/assets/img/welcome/background.svg" /> --}}
                    <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#1e40af] selection:text-white">
                        <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                            <header class="grid grid-cols-1 md:grid-cols-1 items-center gap-2 py-10 lg:grid-cols-3">
                                <div class="flex lg:justify-center lg:col-start-2">
                                    <x-application-logo class="block h-15 w-auto fill-current text-gray-800" />
                                </div>
                                @if (Route::has('login'))
                                    <nav class="-mx-3 flex flex-1 justify-start md:justify-end mt-3">
                                        @auth
                                            <a
                                                href="{{ url('/subvenciones') }}"
                                                class="bg-transparent hover:bg-blue-600 text-blue-800 font-semibold hover:text-white py-2 px-4 border border-blue-600 hover:border-transparent rounded"
                                            >
                                                PANEL DE POSTULACIÓN
                                            </a>
                                        @else
                                            <a
                                                href="{{ route('login') }}"
                                                class="mr-2 bg-transparent hover:bg-blue-600 text-blue-800 font-semibold hover:text-white py-2 px-4 border border-blue-600 hover:border-transparent rounded"
                                            >
                                                INICIAR SESIÓN
                                            </a>
        
                                            @if (Route::has('register'))
                                                <a
                                                    href="{{ route('register') }}"
                                                    class="bg-transparent hover:bg-blue-600 text-blue-800 font-semibold hover:text-white py-2 px-4 border border-blue-600 hover:border-transparent rounded"
                                                >
                                                    REGISTRARSE
                                                </a>
                                            @endif
                                        @endauth
                                    </nav>
                                @endif
                            </header>
        
                            <main class="mt-6">
                                <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">
                                    <a
                                        href="{{ $subsidy_link }}"
                                        target="_blank"
                                        id="docs-card"
                                        class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#1e40af] md:row-span-3 lg:p-10 lg:pb-10"
                                    >
                                        <div id="screenshot-container" class="relative flex w-full flex-1 items-stretch">
                                            <img
                                                src="{{ $cover_image }}"
                                                alt="Laravel documentation screenshot"
                                                class="aspect-auto h-full w-full flex-1 rounded object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.06)]"
                                                onerror="
                                                    document.getElementById('screenshot-container').classList.add('!hidden');
                                                    document.getElementById('docs-card').classList.add('!row-span-1');
                                                    document.getElementById('docs-card-content').classList.add('!flex-row');
                                                    document.getElementById('background').classList.add('!hidden');
                                                "
                                            />
                                            <img
                                                src="https://www.unasam.edu.pe/web/noticiaunasam/noticia-11-04-2024-09-12-51.jpg"
                                                alt="Laravel documentation screenshot"
                                                class="hidden aspect-video h-full w-full flex-1 rounded object-top object-cover drop-shadow-[0px_4px_34px_rgba(0,0,0,0.25)] "
                                            />
                                        </div>
        
                                        <div class="relative flex items-center gap-6 lg:items-end">
                                            <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#1e40af]/10 sm:size-16">
                                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path fill="#1e40af" d="M23 4a1 1 0 0 0-1.447-.894L12.224 7.77a.5.5 0 0 1-.448 0L2.447 3.106A1 1 0 0 0 1 4v13.382a1.99 1.99 0 0 0 1.105 1.79l9.448 4.728c.14.065.293.1.447.1.154-.005.306-.04.447-.105l9.453-4.724a1.99 1.99 0 0 0 1.1-1.789V4ZM3 6.023a.25.25 0 0 1 .362-.223l7.5 3.75a.251.251 0 0 1 .138.223v11.2a.25.25 0 0 1-.362.224l-7.5-3.75a.25.25 0 0 1-.138-.22V6.023Zm18 11.2a.25.25 0 0 1-.138.224l-7.5 3.75a.249.249 0 0 1-.329-.099.249.249 0 0 1-.033-.12V9.772a.251.251 0 0 1 .138-.224l7.5-3.75a.25.25 0 0 1 .362.224v11.2Z"/><path fill="#1e40af" d="m3.55 1.893 8 4.048a1.008 1.008 0 0 0 .9 0l8-4.048a1 1 0 0 0-.9-1.785l-7.322 3.706a.506.506 0 0 1-.452 0L4.454.108a1 1 0 0 0-.9 1.785H3.55Z"/></svg>
                                                </div>
        
                                                <div class="pt-3 sm:pt-5 lg:pt-0">
                                                    <h2 class="text-xl font-semibold text-black">SUBVENCIONES UNASAM</h2>
        
                                                    <p class="mt-4 text-sm/relaxed">
                                                        Estamos encantados de darles la más cordial bienvenida a nuestra plataforma dedicada a facilitar información sobre subvenciones y ayudas disponibles para la comunidad universitaria de la Universidad Nacional Santiago Antúnez de Mayolo (UNASAM).
                                                    </p>
                                                </div>
                                            </div>
        
                                            <svg class="size-6 shrink-0 stroke-[#1e40af]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                                        </div>
                                    </a>
        
                                    <a
                                        href="{{ $unasam_link }}"
                                        target="_blank"
                                        class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#1e40af] lg:pb-10"
                                    >
                                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#1e40af]/10 sm:size-16">
                                            <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><g fill="#1e40af"><path d="M21.721 12.752a9.711 9.711 0 0 0-.945-5.003 12.754 12.754 0 0 1-4.339 2.708 18.991 18.991 0 0 1-.214 4.772 17.165 17.165 0 0 0 5.498-2.477ZM14.634 15.55a17.324 17.324 0 0 0 .332-4.647c-.952.227-1.945.347-2.966.347-1.021 0-2.014-.12-2.966-.347a17.515 17.515 0 0 0 .332 4.647 17.385 17.385 0 0 0 5.268 0ZM9.772 17.119a18.963 18.963 0 0 0 4.456 0A17.182 17.182 0 0 1 12 21.724a17.18 17.18 0 0 1-2.228-4.605ZM7.777 15.23a18.87 18.87 0 0 1-.214-4.774 12.753 12.753 0 0 1-4.34-2.708 9.711 9.711 0 0 0-.944 5.004 17.165 17.165 0 0 0 5.498 2.477ZM21.356 14.752a9.765 9.765 0 0 1-7.478 6.817 18.64 18.64 0 0 0 1.988-4.718 18.627 18.627 0 0 0 5.49-2.098ZM2.644 14.752c1.682.971 3.53 1.688 5.49 2.099a18.64 18.64 0 0 0 1.988 4.718 9.765 9.765 0 0 1-7.478-6.816ZM13.878 2.43a9.755 9.755 0 0 1 6.116 3.986 11.267 11.267 0 0 1-3.746 2.504 18.63 18.63 0 0 0-2.37-6.49ZM12 2.276a17.152 17.152 0 0 1 2.805 7.121c-.897.23-1.837.353-2.805.353-.968 0-1.908-.122-2.805-.353A17.151 17.151 0 0 1 12 2.276ZM10.122 2.43a18.629 18.629 0 0 0-2.37 6.49 11.266 11.266 0 0 1-3.746-2.504 9.754 9.754 0 0 1 6.116-3.985Z"/></g></svg>
                                        </div>
        
                                        <div class="pt-3 sm:pt-5">
                                            <h2 class="text-xl font-semibold text-black">PÁGINA OFICIAL DE LA UNASAM</h2>
        
                                            <p class="mt-4 text-sm/relaxed">
                                                En la página oficial de la UNASAM encontrarás información detallada sobre nuestra oferta académica, servicios estudiantiles, proyectos de investigación, y mucho más. No dudes en explorar nuestro sitio para descubrir todo lo que nuestra universidad tiene para ofrecerte.
                                            </p>
                                        </div>
        
                                        <svg class="size-6 shrink-0 self-center stroke-[#1e40af]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                                    </a>
        
                                    <a
                                        href="{{ $vicerrectorate_link }}"
                                        target="_blank"
                                        class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#1e40af] lg:pb-10"
                                    >
                                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#1e40af]/10 sm:size-16">
                                            <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><g fill="#1e40af"><path d="M8.75 4.5H5.5c-.69 0-1.25.56-1.25 1.25v4.75c0 .69.56 1.25 1.25 1.25h3.25c.69 0 1.25-.56 1.25-1.25V5.75c0-.69-.56-1.25-1.25-1.25Z"/><path d="M24 10a3 3 0 0 0-3-3h-2V2.5a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2V20a3.5 3.5 0 0 0 3.5 3.5h17A3.5 3.5 0 0 0 24 20V10ZM3.5 21.5A1.5 1.5 0 0 1 2 20V3a.5.5 0 0 1 .5-.5h14a.5.5 0 0 1 .5.5v17c0 .295.037.588.11.874a.5.5 0 0 1-.484.625L3.5 21.5ZM22 20a1.5 1.5 0 1 1-3 0V9.5a.5.5 0 0 1 .5-.5H21a1 1 0 0 1 1 1v10Z"/><path d="M12.751 6.047h2a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-2A.75.75 0 0 1 12 7.3v-.5a.75.75 0 0 1 .751-.753ZM12.751 10.047h2a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-2A.75.75 0 0 1 12 11.3v-.5a.75.75 0 0 1 .751-.753ZM4.751 14.047h10a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-10A.75.75 0 0 1 4 15.3v-.5a.75.75 0 0 1 .751-.753ZM4.75 18.047h7.5a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-7.5A.75.75 0 0 1 4 19.3v-.5a.75.75 0 0 1 .75-.753Z"/></g></svg>
                                        </div>
        
                                        <div class="pt-3 sm:pt-5">
                                            <h2 class="text-xl font-semibold text-black ">VICERRECTORADO DE INVESTIGACIÓN</h2>
        
                                            <p class="mt-4 text-sm/relaxed">
                                                Si estás interesado en conocer más sobre las actividades de investigación, proyectos en desarrollo, y las iniciativas lideradas por el Vicerrectorado de Investigación de la Universidad Nacional Santiago Antúnez de Mayolo (UNASAM), te invitamos a visitar su página oficial.
                                            </p>
                                        </div>
        
                                        <svg class="size-6 shrink-0 self-center stroke-[#1e40af]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                                    </a>
        
                                    <a
                                        href="{{ $regulation_link }}"
                                        target="_blank"
                                        class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#1e40af] lg:pb-10"
                                    >
                                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#1e40af]/10 sm:size-16">
                                            <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><g fill="#1e40af"><path d="M8.75 4.5H5.5c-.69 0-1.25.56-1.25 1.25v4.75c0 .69.56 1.25 1.25 1.25h3.25c.69 0 1.25-.56 1.25-1.25V5.75c0-.69-.56-1.25-1.25-1.25Z"/><path d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z"/></g></svg>
                                        </div>
        
                                        <div class="pt-3 sm:pt-5">
                                            <h2 class="text-xl font-semibold text-black ">REGLAMENTO DE SUBVENCIONES ECONÓMICAS</h2>
        
                                            <p class="mt-4 text-sm/relaxed">
                                                Si deseas conocer más sobre el reglamento que rige las subvenciones y ayudas disponibles en la Universidad Nacional Santiago Antúnez de Mayolo (UNASAM), te invitamos a consultar el documento oficial.
                                            </p>
                                        </div>
        
                                        <svg class="size-6 shrink-0 self-center stroke-[#1e40af]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                                    </a>
        
                                </div>
                            </main>
        
                            <footer class="py-16 text-center text-sm text-black">
                                {{-- Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) --}}
                            </footer>
                        </div>
                    </div>
                </div>

            </main>
        </div>
        
        @stack('scripts')
    </body>
</html>
