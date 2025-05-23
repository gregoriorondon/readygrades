<form>
  <div class="space-y-12 p-[21px]">
    <div class="border-gray-900/10 pb-12">
      <p class="mt-7 text-xl font-inter text-gray-400">Rellene todas las casillas para registrar al nuevo profesor en la institución</p>

    <div class="border-gray-900/10 pb-12">
      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <div class="mt-2">
          <x-label>Nombre Completo</x-label>
            <x-input-form type="text" name="primer-name" id="first-name" placeholder="Primer Nombre" />
            <x-input-form type="text" name="segundo-name" id="first-name" placeholder="Segundo Nombre" />
          </div>
        </div>

        <div class="sm:col-span-3">
          <div class="mt-2">
          <x-label>Apellido Completo</x-label>
            <x-input-form type="text" name="primer-apellido" id="last-name" placeholder="Primer Apellido" />
            <x-input-form type="text" name="segundo-apellido" id="last-name" placeholder="Segundo Apellido" />
          </div>
        </div>

        <div class="sm:col-span-2 mt-2 sm:col-start-1">
        <x-label>Genero / Sexo</x-label>
            <div class="flex items-center">
            <x-select-form class="sm:max-w-full" >
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
            </x-select-form>
            </div>
        </div>

        <div class="sm:col-span-2">
          <div class="mt-2">
          <x-label>Nacionalidad</x-label>
            <x-select-form  class="sm:max-w-full" id="nacionalidad">
                <option value="">Venezolano(a)</option>
                <option value="">Extranjero(a)</option>
            </x-select-form>
          </div>
        </div>

        <div class="sm:col-span-2">
          <div class="mt-2">
          <x-label>Cedula de Identidad</x-label>
            <x-input-form class="sm:max-w-full" type="number" name="cedula" id="cedula" placeholder="Número de Cedula" />
          </div>
        </div>


        <div class="sm:col-span-2 sm:col-start-1">
          <div class="mt-2">
          <x-label>Correo / Email</x-label>
            <x-input-form type="email" name="email" id="email" placeholder="Correo Electrónico del Profesor" />
          </div>
        </div>

        <div class="sm:col-span-2">
          <div class="mt-2">
          <x-label>Contraseña</x-label>
            <x-input-form type="password" name="password" id="password" placeholder="Contrasña Temporal para Iniciar Sesión" />
          </div>
        </div>


        <div class="sm:col-span-2">
          <div class="mt-2">
          <x-label>Confirmar Contraseña</x-label>
            <x-input-form type="password" name="password" id="password" placeholder="Confirmar Contraseña" />
          </div>
        </div>

        <div class="sm:col-span-2 sm:col-start-1">
          <div class="mt-2">
          <x-label>Carrera Destacada del Docente</x-label>
            <x-select-form class="sm:max-w-full" id="carrera">
              <option>Administración</option>
              <option>Informática</option>
              <option>Maquinaria Pesada</option>
            </x-select-form>
          </div>
        </div>
        <div class="sm:col-span-2">
          <div class="mt-2">
          <x-label>Tipo de Profesor</x-label>
            <x-select-form class="sm:max-w-full" id="trayecto" name="trayecto">
                <option value="trayecto-cuatro-tramo-12">Profesor Corriente</option>
                <option value="trayecto-inicial">Profesor Guia</option>
            </x-select-form>
          </div>

        </div>
      </div>
    </div>
  <div class="mt-6 flex items-center justify-end gap-x-6">
    <button type="reset" class="font-inter font-extrabold rounded-md bg-[#d84242] px-3 py-2 text-sm/6 font-semibold text-white shadow-sm hover:bg-[#670f0f] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Limpiar <i class="fa-solid fa-eraser m-0"></i></button>
    <button type="submit" class="font-inter font-extrabold rounded-md bg-ready px-3 py-[0.7rem] text-sm font-semibold text-white shadow-sm hover:bg-[#0f2167] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Registrar <i class="fa-solid fa-floppy-disk m-0"></i></button>
  </div>
</form>

