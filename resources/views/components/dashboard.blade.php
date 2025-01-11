<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $titulo }}</title>
        <x-import/>

    </head>
    <body class="font-sans antialiased">
        {{-- <x-banner /> --}}

        {{-- <div class="min-h-screen bg-gray-100"> --}}
        {{--     <!-- Page Heading --> --}}
        {{--     @if (isset($header)) --}}
        {{--         <header class="bg-white "> --}}
        {{--             <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"> --}}
        {{--                 {{ $header }} --}}
        {{--             </div> --}}
        {{--         </header> --}}
        {{--     @endif --}}
        {{--     <!-- Page Content --> --}}
    <div id="menu">
        <div class="flex h-screen menu-admin-dashboard">
            <!-- sidebar -->
            <div class="menu-hiden menu-admin-dashboard hidden md:flex flex-col w-64">
                <div class="flex items-center justify-center h-16">
                    <span class="font-bold font-inter uppercase"><i class="fa-solid fa-user-tie"></i>Administrador</span>
                </div>
                <div class="flex flex-col flex-1 overflow-y-auto">
                    <nav class="flex-1 px-2 py-4">
                        <x-sidebar-section href="/administracion"><i class="fa-solid fa-house"></i>Dashboard</x-sidebar-section>
                        <details class="register-add-sidebar-details">
                            <summary class="cursor-pointer px-4 py-2 mt-2 font-inter"><i class="fa-solid fa-address-book"></i>Registros</summary>
                                <x-sidebar-section><i class="fa-solid fa-square-plus"></i>Registrar Estudiantes</x-sidebar-section>
                                <x-sidebar-section><i class="fa-solid fa-user-plus"></i>Registrar Profesor</x-sidebar-section>
                                <x-sidebar-section><i class="fa-solid fa-address-card"></i>Registrar Administrador</x-sidebar-section>
                        </details>
                        <x-sidebar-section href="/student"><i class="fa-solid fa-user-graduate"></i>Estudiantes</x-sidebar-section>
                        <x-sidebar-section href="/courses"><i class="fa-solid fa-graduation-cap"></i>Carreras</x-sidebar-section>
                    </nav>
                </div>
            </div>
            <!-- Main content -->
            <div class="flex flex-col flex-1 overflow-y-auto rounded-l-xl main-content redondeado">
                <div class="flex items-center justify-between h-16 bg-white border-b border-gray-200" @style('padding: 16px 0px 16px 0px')>
                    <div class="flex items-center px-4">
                        <button class="menu-hiden-button hover:bg-gray-100 rounded-lg py-1 px-2 text-2xl"><i class="fa-solid fa-bars m-0"></i></button>
                        <button class="menu-button-hiden hover:bg-gray-100 rounded-lg py-1 px-2 text-2xl"><i class="fa-solid fa-bars m-0"></i></button>
                        <p class="mx-4 w-full ">Bienvenido/Bienvenida Usuario</p>
                    </div>
                    <script src="{{ Vite::asset('resources/js/menu-admin-hide.js')}}"></script>
                    <div class="flex items-center pr-4">
                        <button class="flex items-center hover:bg-gray-100 px-3 py-2 rounded-xl font-inter text-2xl"><i class="fa-solid fa-arrow-right-from-bracket m-0"></i></button>
                    </div>
                </div>
                <div class="p-4 rounded-lg">
                    <h1 class="text-4xl text-center font-bold font-inter">Dashboard Principal</h1>
                    {{-- <p class="mt-2 text-gray-600 font-inter">Resumen y estadistica general</p> --}}
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
        </div>
    </div>
        {{-- @stack('modals') --}}
    </body>
</html>
