<form action="POST">
    @csrf
    @props(['datos', 'sessiones'])
        <div class="space-y-12 p-[21px]">
        <div>
            <p class="mt-7 text-xl font-inter text-gray-400">Editar Datos Personales</p>
            <x-horizontalline />
        </div>
            <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            @foreach($datos as $dato)
                <div class="sm:col-span-3">
                    <x-label>Nombre Completo</x-label>
                    <x-input-form type="text" name="primer-name" value="{{ $dato['primer-name'] }}" placeholder="Primer Nombre (Obligatorio)" autocomplete="off" />
                    <x-input-form type="text" name="segundo-name" value="{{ $dato['segundo-name'] }}" placeholder="Segundo Nombre" autocomplete="off" />
                </div>
                <div class="sm:col-span-3">
                    <x-label>Apellido Completo</x-label>
                    <x-input-form type="text" name="primer-apellido" value="{{ $dato['primer-apellido'] }}" placeholder="Primer Apellido (Obligatorio)" autocomplete="off" />
                    <x-input-form type="text" name="segundo-apellido" value="{{ $dato['segundo-apellido'] }}" placeholder="Segundo Apellido" autocomplete="off" />
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
                    <x-select-form  class="sm:max-w-full" id="nacionalidad" name="nacionalidad">
                        <option value="VE">Venezolano(a)</option>
                        <option value="EX">Extranjero(a)</option>
                    </x-select-form>
                </div>
                <div class="sm:col-span-2">
                    <x-label>Cédula</x-label>
                    <x-input-form type="text" name="cedula" value="{{ $dato['cedula'] }}" placeholder="Coloque Su Cédula" autocomplete="off" />
                </div>
                <div class="sm:col-span-full sm:col-start-1">
                    <p class="mt-7 text-xl font-inter text-gray-400">Editar Acceso</p>
                    <x-horizontalline />
                </div>
                <div class="sm:col-span-2 sm:col-start-1">
                    <x-label>Correo / Email</x-label>
                    <x-input-form type="email" name="email" id="email" value="{{ $dato->email }}" placeholder="Correo Electrónico" required autocomplete="off" />
                </div>
            @endforeach
                <div class="sm:col-span-2">
                    <x-label>Contraseña</x-label>
                    <x-input-form type="password" name="password" id="password" placeholder="Nueva Contrasña" required autocomplete="off" />
                </div>
                <div class="sm:col-span-2">
                    <x-label>Confirmar Contraseña</x-label>
                    <x-input-form type="password" name="password_confirmation" id="password" placeholder="Confirmar Nueva Contraseña" required autocomplete="off" />
                </div>
                <x-input-error class="sm:col-span-6 mt-[-14px]" name="password" />
                <div class="sm:col-span-full sm:col-start-1">
                    <p class="mt-7 text-xl font-inter text-gray-400">Sesiones Activas En Otros Navegadores</p>
                    <x-horizontalline />
                </div>
            @foreach($sessiones as $session)
                <div class="sm:col-span-3">
                    <x-label>Navegador</x-label>
                    <x-span>{{ $session['user_agent'] }}</x-span>
                    <x-span>{{ $session['ip_address'] }}</x-span>
                </div>
            @endforeach
            </div>
        </div>
</form>
