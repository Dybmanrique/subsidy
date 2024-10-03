<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Actualice la información de su cuenta.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        @if (!$user->is_admin)
            <div>
                <x-input-label for="dni" :value="__('DNI')" />
                <x-text-input id="dni" name="dni" type="text" class="mt-1 block w-full text-gray-700" :value="old('dni', $user->student->dni)" disabled autocomplete="dni" />
                <x-input-error class="mt-2" :messages="$errors->get('dni')" />
            </div>
        @endif

        <div>
            <x-input-label for="email" :value="__('Correo Institucional')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full text-gray-700" :value="old('email', $user->email)" disabled autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="name" :value="__('Nombres')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Apellidos')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>
        @if (!$user->is_admin)
        <div>
            <x-input-label for="phone" :value="__('Celular')" />
            <x-text-input id="phone" name="phone" type="number" class="mt-1 block w-full" :value="old('phone', $user->student->phone)" required autofocus autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="condition" :value="__('Condición')" />
            <select name="condition" id="condition" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">--Seleccione--</option>
                <option value="estudiante" {{ old('condition', $user->student->condition) === 'estudiante' ? 'selected' : '' }}>Estudiante</option>
                <option value="egresado" {{ old('condition', $user->student->condition) === 'egresado' ? 'selected' : '' }}>Egresado</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('condition')" />
        </div>

        <div>
            <x-input-label for="school_id" :value="__('Escuela')" />
            <select name="school_id" id="school_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="">--Seleccione--</option>
                @foreach ($schools as $school)
                    <option value="{{ $school->id }}" {{ old('school_id', $user->student->school_id) === $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('school_id')" />
        </div>
        @endif
        

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
