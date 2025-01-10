 <script defer src="js/alpinejs@3-x-x.js"></script>
<x-guest>
 <x-slot:titulo>Iniciar sesión como administrador</x-slot:titulo>
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

        <div class="mb-7">
            <h1 style="font-size: 40px; font-weight: 700; color: #4272D8;">Iniciar Sesión Como Administrador</h1>
            <p>Introduce tu usuario y contraseña para acceder</p>
        </div>
        {{-- <form method="POST" action="{{ route('login') }}"> --}}
        <form method="POST">
            @csrf
            <div>
                <x-input i="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Usuario o Correo" />
            </div>
            <div class="mt-4">
                <x-input id="password" class="rounded-md border-gray-300 block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Contraseña" />
                <button class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-#4CB9E7 mt-3" type="button"><i class="fa-regular fa-eye"></i>Ver Contraseña</button>
            </div>

            <!-- <div class="block" style="margin-top: 30px;">
                <label for="remember_me" class="flex items-center">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-#4CB9E7" href="{{ route('password.request') }}">
                        {{-- {{ __('Perdio su Contraseña?') }} --}}
                    </a>
                @endif
                </label>
            </div> -->

            <div class="flex items-center justify-end mt-4">
                <x-button-login class="mt-7 text-white">
                    Iniciar Sesión
                </x-button-login>
            </div>
        </form>
    <div class="pt-[35%] text-center text-[#7B7B7B]">
        <span>Si no esta registrado, diríjase al A.R.S.C.E</span>
    </div>
    </x-authentication-card>
</x-guest>
