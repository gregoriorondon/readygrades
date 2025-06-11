<form method="POST" action="/registro">
    @csrf
  <div class="space-y-12 p-[21px]">
    <div class="border-gray-900/10 pb-12">
      <p class="mt-7 text-xl font-inter text-gray-400">Rellene todas las casillas para registrar al nuevo administrador en la institución</p>

    <div class="border-gray-900/10 pb-12">
      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <div class="mt-2">
          <x-label>Nombre Completo</x-label>
            <x-input-form type="text" name="primer-name" id="first-name" :value="old('primer-name')" placeholder="Primer Nombre" required autocomplete="off" />
            <x-input-form type="text" name="segundo-name" id="first-name" :value="old('segundo-name')"  placeholder="Segundo Nombre" autocomplete="off" />
            <x-input-error name="primer-name" />
          </div>
        </div>

        <div class="sm:col-span-3">
          <div class="mt-2">
          <x-label>Apellido Completo</x-label>
            <x-input-form type="text" name="primer-apellido" id="last-name" :value="old('primer-apellido')"  placeholder="Primer Apellido" required autocomplete="off" />
            <x-input-form type="text" name="segundo-apellido" id="last-name" :value="old('segundo-apellido')"  placeholder="Segundo Apellido" autocomplete="off" />
            <x-input-error name="primer-apellido" />
          </div>
        </div>

        <div class="sm:col-span-2 mt-2 sm:col-start-1">
        <x-label>Genero / Sexo</x-label>
            <div class="flex items-center">
            <x-select-form class="sm:max-w-full" name="genero">
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
            </x-select-form>
            </div>
        </div>

        <div class="sm:col-span-2">
          <div class="mt-2">
          <x-label>Nacionalidad</x-label>
            <x-select-form  class="sm:max-w-full" id="nacionalidad" name="nacionalidad">
                <option value="VE">Venezolano(a)</option>
                <option value="EX">Extranjero(a)</option>
            </x-select-form>
          </div>
        </div>

        <div class="sm:col-span-2">
          <div class="mt-2">
          <x-label>Cedula de Identidad</x-label>
            <x-input-form class="sm:max-w-full" type="number" name="cedula" id="cedula" :value="old('cedula')"  placeholder="Número de Cedula" required autocomplete="off" />
            <x-input-error name="cedula" />
          </div>
        </div>

        <div class="sm:col-span-2 sm:col-start-1">
          <div class="mt-2">
          <x-label>Correo / Email</x-label>
            <x-input-form type="email" name="email" id="email" :value="old('email')"  placeholder="Correo Electrónico del Administrador" required autocomplete="off" />
            <x-input-error name="email" />
          </div>
        </div>

        <div class="sm:col-span-2">
          <div class="mt-2">
          <x-label>Contraseña</x-label>
            <x-input-form type="password" name="password" id="password" placeholder="Contrasña Temporal para Iniciar Sesión" required autocomplete="off" />
          </div>
        </div>

        <div class="sm:col-span-2">
          <div class="mt-2">
          <x-label>Confirmar Contraseña</x-label>
            <x-input-form type="password" name="password_confirmation" id="password" placeholder="Confirmar Contraseña" required autocomplete="off" />
          </div>
        </div>
        <x-input-error class="sm:col-span-6 mt-[-14px]" name="password" />

    <div class="gap-x-6 gap-y-8 sm:grid-cols-6 divcarreratramonucleo">
        <div class="carreratramonucleo">
          <div class="mt-2">

          <x-label class="after:content-['*'] after:text-red-400">Titulo Obtenido</x-label>
          @props(['cargo', 'estudio', 'nucleo'])
          <x-select-form class="sm:max-w-full" name="cargo_id" id="carreras_id" >
                @foreach($cargo as $cargos)
                    <option value="{{ $cargos->id }}">{{ strtoupper($cargos->cargo) }}</option>
                @endforeach
            </x-select-form>
            <x-input-error name="cargo_id" />
          </div>
        </div>
        <div class="carreratramonucleo">
          <div class="mt-2">
          <x-label class="after:content-['*'] after:text-red-400">Cargo A Ejercer</x-label>
            <x-select-form class="sm:max-w-full" name="estudio_id">
                @foreach($estudio as $estudios)
                    <option value="{{ $estudios->id }}">{{ strtoupper($estudios->estudio) }} - ({{ strtoupper($estudios->abrev) }})</option>
                @endforeach
            </x-select-form>
            <x-input-error name="estudio_id" />
          </div>
        </div>
        <div class="carreratramonucleo">
          <div class="mt-2">
          <x-label class="after:content-['*'] after:text-red-400">Núcleo</x-label>
            <x-select-form class="sm:max-w-full" name="nucleo_id">
                @foreach($nucleo as $nucleos)
                    <option value="{{ $nucleos->id }}">{{ $nucleos->nucleo }}</option>
                @endforeach
            </x-select-form>
            <x-input-error name="nucleo_id" />
          </div>
        </div>
    </div>

      </div>
    </div>
  <div class="mt-6 flex items-center justify-end gap-x-6">
    <button type="reset" class="font-inter font-extrabold rounded-md bg-[#d84242] px-3 py-2 text-sm/6 font-semibold text-white shadow-sm hover:bg-[#670f0f] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Limpiar <i class="fa-solid fa-eraser m-0"></i></button>
    <button type="submit" class="font-inter font-extrabold rounded-md bg-ready px-3 py-[0.7rem] text-sm font-semibold text-white shadow-sm hover:bg-[#0f2167] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Registrar <i class="fa-solid fa-floppy-disk m-0"></i></button>
  </div>
</form>

