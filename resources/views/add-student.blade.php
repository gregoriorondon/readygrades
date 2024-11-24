<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#4272D8] leading-tight">
            {{ __('Registrar Nuevo Estudiante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-form-student />
            </div>
        </div>
    </div>
</x-app-layout>
