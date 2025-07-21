<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $titulo }}</title>
        <x-import/>

    </head>
    <body class="font-inter antialiased">
    <div id="menu">
        <div class="flex h-screen menu-admin-dashboard">
            <!-- sidebar -->
            <div class="menu-hiden menu-admin-dashboard hidden md:flex flex-col w-64">
                <div class="flex items-center justify-center h-16">
                    @can('admins')
                        <span class="font-bold font-inter uppercase"><i class="fa-solid fa-user-tie"></i>Administrador</span>
                    @endcan
                    @can('root')
                        <span class="font-bold font-inter uppercase"><i class="fa-solid fa-lock"></i>Super Admin</span>
                    @endcan
                    @can('profesor')
                        <span class="font-bold font-inter uppercase"><i class="fa-solid fa-chalkboard-user"></i>Docente</span>
                    @endcan
                </div>
                <div class="flex flex-col flex-1 overflow-y-auto">
                    <nav class="flex-1 px-2 py-4">
                        <x-nav-admin />
                    </nav>
                </div>
            </div>
            <!-- sidebar Movil -->
            <div class="menu-admin-dashboard sidebar-movil -translate-x-96 flex md:hidden flex-col w-64 fixed z-[3] h-screen">
                <div class="flex items-center justify-center h-16">
                    @can('admins')
                        <span class="font-bold font-inter uppercase"><i class="fa-solid fa-user-tie"></i>Administrador</span>
                    @endcan
                    @can('root')
                        <span class="font-bold font-inter uppercase"><i class="fa-solid fa-lock"></i>Super Admin</span>
                    @endcan
                    @can('profesor')
                        <span class="font-bold font-inter uppercase"><i class="fa-solid fa-chalkboard-user"></i>Docente</span>
                    @endcan
                    <span class="close-sidebar-movil bg-[#f00] hover:bg-[#b00] rounded-lg cursor-pointer p-1 px-3 ml-4 transition-all"><i class="fa-solid fa-xmark flex py-1 m-0"></i></span>
                </div>
                <div class="flex flex-col flex-1 overflow-y-auto">
                    <nav class="flex-1 px-2 py-4">
                        <x-nav-admin />
                    </nav>
                </div>
            </div>

            <!-- Main content -->
            <div class="flex flex-col flex-1 overflow-y-auto md:rounded-l-xl main-content redondeado">
                <div class="flex items-center justify-between h-16 border-b border-gray-200" @style('padding: 16px 0px 16px 0px')>
                    <div class="hidden md:flex items-center px-4 space-x-7">
                        <button class="menu-hiden-button hover:bg-blue-400/50 rounded-lg py-1 px-2 text-xl"><i class="fa-regular fa-sidebar m-0"></i></button>
                        <button class="menu-button-hiden hover:bg-blue-400/50 rounded-lg py-1 px-2 text-xl"><i class="fa-regular fa-sidebar m-0"></i></button>
                        @cannot('profesor')
                            <p class="mx-4 w-full ">Panel Administrativo</p>
                        @endcannot
                        @can('profesor')
                            <p class="mx-4 w-full ">Gestión Académica</p>
                        @endcannot
                    </div>
                    <!-- INICIO VERSION MOVIL -->
                    <div class="md:hidden flex items-center px-4 space-x-7">
                        <button class="menu-hiden-button-movil hover:bg-blue-400/50 rounded-lg py-1 px-2 text-xl"><i class="fa-regular fa-sidebar m-0"></i></button>
                        @cannot('profesor')
                            <p class="mx-4 w-full ">Panel Administrativo</p>
                        @endcannot
                        @can('profesor')
                            <p class="mx-4 w-full ">Gestión Académica</p>
                        @endcannot
                    </div>
                    <!-- FIN VERSION MOVIL -->
                    <div class="flex items-center pr-4 space-x-4">
                        @cannot('profesor')
                            <a href="/config" id="conf" class="cursor-pointer flex items-center hover:bg-blue-400/50 px-3 py-2 rounded-xl font-inter text-xl" title="Ir A Las Configuraciones"><i class="fa-solid fa-gear m-0"></i></a>
                        @endcannot
                        <button id="dark" class="flex items-center hover:bg-blue-400/50 px-3 py-2 rounded-xl font-inter text-xl" title="Cambiar A Modo Oscuro"><i class="fa-solid fa-moon m-0"></i></button>
                        <button id="light" class="hidden items-center hover:bg-blue-400/50 px-3 py-2 rounded-xl font-inter text-xl" title="Cambiar A Modo Claro"><i class="fa-solid fa-sun m-0"></i></button>
                        <form method="POST" action="/logout">
                            @csrf
                            <button class="flex items-center hover:bg-blue-400/50 px-3 py-2 rounded-xl font-inter text-xl" title="Cerrar Sesión"><i class="fa-solid fa-arrow-right-from-bracket m-0"></i></button>
                        </form>
                    </div>
                </div>
                <div class="p-4 rounded-lg">
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
            @vite(['resources/js/dark-light-mode.js', 'resources/js/menu-admin-hide.js'])
        </div>
    </div>
        {{-- @stack('modals') --}}
    </body>
</html>
