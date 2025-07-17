<form action="/config-save-basic" method="POST" id="formularioNombres">
    @csrf
    @props(['datos', 'sesiones'])
    <div class="space-y-12 p-[21px]">
        <div>
            <p class="mt-7 text-xl font-inter text-gray-400 capitalize">Información de su perfil</p>
            <x-horizontalline />
        </div>
        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            {{-- @foreach ($datos as $dato) --}}
            <div class="sm:col-span-3">
                <x-label>Nombre Completo</x-label>
                <x-input-form type="text" name="primer-name" value="{{ $datos['primer-name'] }}"
                    placeholder="Primer Nombre (Obligatorio)" autocomplete="off" />
                <x-input-form type="text" name="segundo-name" value="{{ $datos['segundo-name'] }}"
                    placeholder="Segundo Nombre" autocomplete="off" />
            </div>
            <div class="sm:col-span-3">
                <x-label>Apellido Completo</x-label>
                <x-input-form type="text" name="primer-apellido" value="{{ $datos['primer-apellido'] }}"
                    placeholder="Primer Apellido (Obligatorio)" autocomplete="off" />
                <x-input-form type="text" name="segundo-apellido" value="{{ $datos['segundo-apellido'] }}"
                    placeholder="Segundo Apellido" autocomplete="off" />
            </div>
            <div class="sm:col-span-2 sm:col-start-1">
                <x-label>Genero / Sexo</x-label>
                <x-select-form class="sm:max-w-full" name="genero">
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </x-select-form>
            </div>
            <div class="sm:col-span-2">
                <x-label>Nacionalidad</x-label>
                <x-select-form class="sm:max-w-full" id="nacionalidad" name="nacionalidad">
                    <option value="VE">Venezolano(a)</option>
                    <option value="EX">Extranjero(a)</option>
                </x-select-form>
            </div>
            <div class="sm:col-span-2">
                <x-label>Cédula</x-label>
                <x-input-form type="text" name="cedula" value="{{ $datos['cedula'] }}"
                    placeholder="Coloque Su Cédula" autocomplete="off" />
            </div>
        </div>
</form>
<div class="flex justify-between">
    <x-button class="w-fit bg-[#f00] hover:bg-[#b00]" type="button" onclick="history.back()">Cancelar</x-button>
    <x-button class="w-fit" type="submit" form="formularioNombres">Guardar</x-button>
</div>
{{-- <div class="sm:col-span-full sm:col-start-1"> --}}
{{--     <p class="mt-7 text-xl font-inter text-gray-400">Editar Acceso</p> --}}
{{--     <x-horizontalline /> --}}
{{-- </div> --}}
{{-- <form class="contents"> --}}
{{--     @csrf --}}
{{--     <div class="sm:col-span-2 sm:col-start-1"> --}}
{{--         <x-label>Correo / Email</x-label> --}}
{{--         <x-input-form type="email" name="email" id="email" value="{{ $datos->email }}" --}}
{{--             placeholder="Correo Electrónico" required autocomplete="off" /> --}}
{{--     </div> --}}
{{-- @endforeach --}}
{{--     <div class="sm:col-span-2"> --}}
{{--         <x-label>Contraseña</x-label> --}}
{{--         <x-input-form type="password" name="password" id="password" placeholder="Nueva Contrasña" required --}}
{{--             autocomplete="off" /> --}}
{{--     </div> --}}
{{--     <div class="sm:col-span-2"> --}}
{{--         <x-label>Confirmar Contraseña</x-label> --}}
{{--         <x-input-form type="password" name="password_confirmation" id="password" --}}
{{--             placeholder="Confirmar Nueva Contraseña" required autocomplete="off" /> --}}
{{--     </div> --}}
{{--     <x-input-error class="sm:col-span-6 mt-[-14px]" name="password" /> --}}
{{-- </form> --}}
{{-- --}}
<div class="sm:col-span-full sm:col-start-1">
    <p class="mt-7 text-xl font-inter text-gray-400">Sesiones Activas En Otros Navegadores</p>
    <x-horizontalline />
</div>
<div class="sm:col-span-full sm:col-start-1 overflow-hidden border border-gray-400 rounded-lg ">
    <table class="min-w-full table-fixed font-inter font-normal text-lg">
        <thead class="border-b">
            <tr class="text-left">
                <x-table-th-students><i class="fas fa-map-marked-alt"></i>IP</x-table-th-students>
                <x-table-th-students><i class="fab fa-safari"></i>Navegador</x-table-th-students>
                <x-table-th-students><i class="fas fa-calendar-alt"></i>Inicio</x-table-th-students>
                <x-table-th-students><i class="fas fa-bolt"></i>Acción</x-table-th-students>
            </tr>
        </thead>
        <tbody>
            @foreach ($sesiones as $sesion)
                <tr class="pt-3 odd:bg-gray-100/20 event:bg-transparent event:border-b ">
                    <x-table-td-students>{{ $sesion->ip_address }}</x-table-td-students>
                    <x-table-td-students class="text-wrap mx-w-40">{{ $sesion->user_agent }}</x-table-td-students>
                    <x-table-td-students>{{ $sesion->created_at }}</x-table-td-students>
                    <x-table-td-students>
                        @if (session('session_token') !== $sesion->session_token)
                            <form method="POST" action="{{ route('auth.delete', $sesion->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="bg-[#f00] p-2 rounded-lg hover:bg-[#b00]" type="submit">Cerrar</button>
                            </form>
                        @else
                            Sesión actual
                        @endif
                    </x-table-td-students>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>
