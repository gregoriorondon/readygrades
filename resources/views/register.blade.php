<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#4272D8] leading-tight">
            {{ __('Ristrar Nuevo Administrador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" placeholder="Nombre del Nuevo Administrador"/>
            </div>

            <div class="mt-4">
                <x-input id="cedula" class="block mt-1 w-full" type="number" name="cedula" :value="old('cedula')" required autocomplete="name" placeholder="Número de Cedula"/>
            </div>


            <div class="mt-4">
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Usuario o Correo"/>
            </div>

            <div class="mt-4">
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Contraseña"/>
            </div>

            <div class="mt-4">
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar Contraseña" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button-login class="">
                    {{ __('Registrar Administrador') }}
                </x-button-login>
            </div>
        </form>
    </x-authentication-card>


            </div>
        </div>
    </div>
</x-app-layout>

