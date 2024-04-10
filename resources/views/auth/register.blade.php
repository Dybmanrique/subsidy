<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!--DNI -->
        <div >
            <x-input-label for="dni" :value="__('DNI')" />
            <x-text-input id="dni" class="block mt-1 w-full" type="number" name="dni" :value="old('dni')" required autofocus autocomplete="dni" />
            <x-input-error :messages="$errors->get('dni')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!--Last Name -->
        <div class="mt-4">
            <x-input-label for="last_name" :value="__('Apellidos')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo institucional')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!--Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Celular')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!--School -->
        <div class="mt-4">
            <x-input-label for="school_id" :value="__('Escuela profesional')" />
            <select name="school_id" id="school_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">-- Seleccione --</option>
                @foreach ($schools as $school)
                    <option value="{{$school->id}}" {{($school->id == old('school_id') ? 'selected' : null)}}>{{$school->name}}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('school_id')" class="mt-2" />
        </div>

        <!--Condition -->
        <div class="mt-4">
            <x-input-label for="condition" :value="__('Condición')" />
            <select name="condition" id="condition" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">-- Seleccione --</option>
                <option value="estudiante" {{("estudiante" == old('condition') ? 'selected' : null)}}>Estudiante</option>
                <option value="egresado" {{("egresado" == old('condition') ? 'selected' : null)}}>Egresado</option>
            </select>
            <x-input-error :messages="$errors->get('condition')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
