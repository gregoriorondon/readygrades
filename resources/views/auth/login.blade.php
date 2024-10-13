 <script defer src="js/alpinejs@3-x-x.js"></script>
 <title>Iniciar Sesión</title>
 <x-import></x-import>
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Correo') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div x-data="{show: false}" class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <input id="password" class="rounded-md border-gray-300 block mt-1 w-full" :type="show ? 'text' : 'password'" name="password" required autocomplete="current-password" />
                <button class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-#4CB9E7 mt-3" type="button" @click="show= !show"><i class="fa-regular fa-eye"></i>Ver Contraseña</button>
            </div>

            <div class="block" style="margin-top: 30px;">
                <label for="remember_me" class="flex items-center">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-#4CB9E7" href="{{ route('password.request') }}">
                        {{ __('Perdio su Contraseña?') }}
                    </a>
                @endif
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                 <a class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-#4CB9E7" href="{{ route('register') }}">
                    {{ __('Registrarse') }}
                </a>

                <x-button class="ms-4">
                    {{ __('Iniciar Sesión') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
