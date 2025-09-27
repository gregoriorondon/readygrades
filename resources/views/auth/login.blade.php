<x-guest>
 <x-slot:titulo>Iniciar sesión</x-slot:titulo>
 <x-menuuptt />
     @vite(['public/css/menu.css', 'public/css/style.css'])
    <x-authentication-card>
        <x-slot name="logo">
           <x-authentication-card-logo />
        </x-slot>

        {{-- @session('status') --}}
        {{--     <div class="mb-4 font-medium text-sm text-green-600"> --}}
        {{--         {{ $value }} --}}
        {{--     </div> --}}
        {{-- @endsession --}}

        <x-login-name>
            Iniciar Sesión
        </x-login-name>

        <form method="POST" action="/login">
            @csrf
            <div>
                <x-input i="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Usuario o Correo" />
                <x-input-error name="email" />
            </div>
            <div class="mt-4">
                <div class="relative">
                <x-input id="password" class="rounded-md pr-24 border-gray-300 block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Contraseña" />
                <button class="passbtn font-inter bg-gray-200 text-sm text-gray-600 hover:text-gray-900 absolute rounded-md right-px top-1/2 -translate-y-1/2 p-2.5" type="button"><i class="fa-regular fa-eye"></i>Mostrar</button>
                <button class="passbtnhidde hidden font-inter bg-gray-200 text-sm text-gray-600 hover:text-gray-900 absolute rounded-md right-px top-1/2 -translate-y-1/2 p-2.5" type="button"><i class="fa-regular fa-eye-slash"></i>Ocultar</button>
                @vite(['resources/js/password-show-hide.js'])</div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button-login class="mt-7">
                    Iniciar Sesión
                </x-button-login>
            </div>
        </form>
    <div class="pt-[35%] text-center font-inter text-[#7B7B7B]">
        <span class="font-inter">Si no esta registrado, diríjase al A.R.S.C.E</span>
    </div>
    </x-authentication-card>
    <x-footer-original />
</x-guest>
