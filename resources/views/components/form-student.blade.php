<form method="POST" action="/registro-estudiante">
    @csrf
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

  <div class="space-y-12 p-[21px]">
    <div class="border-gray-900/10 pb-12">
      <p class="mt-7 text-xl font-inter text-gray-400">Rellene todas las casillas para registrar al nuevo estudiante en la institución</p>

    <div class="border-gray-900/10 pb-12">
      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <div class="mt-2">
          <x-label>Nombre Completo</x-label>
            <x-input-form type="text" name="primer-name" id="first-name" placeholder="Primer Nombre" :value="old('primer-name')" required />
            <x-input-form type="text" name="segundo-name" id="first-name" placeholder="Segundo Nombre" :value="old('segundo-name')" required  />
          </div>
        </div>

        <div class="sm:col-span-3">
          <div class="mt-2">
          <x-label>Apellido Completo</x-label>
            <x-input-form type="text" name="primer-apellido" id="last-name" placeholder="Primer Apellido" :value="old('primer-apellido')" required  />
            <x-input-form type="text" name="segundo-apellido" id="last-name" placeholder="Segundo Apellido" :value="old('segundo-apellido')" required  />
          </div>
        </div>

        <div class="sm:col-span-1 mt-2 sm:col-start-1">
        <x-label>Genero / Sexo</x-label>
            <div class="flex items-center">
            <x-select-form class="sm:max-w-full" name="genero" >
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
            </x-select-form>
            </div>
        </div>


        <div class="sm:col-span-1">
          <div class="mt-2">
          <x-label>Nacionalidad</x-label>
            <x-select-form  class="sm:max-w-full" id="nacionalidad" name="nacionalidad" >
                <option value="VE">Venezolano(a)</option>
                <option value="EX">Extranjero(a)</option>
            </x-select-form>
          </div>
        </div>

        <div class="sm:col-span-2">
          <div class="mt-2">
          <x-label>Cédula de Identidad</x-label>
            <x-input-form class="sm:max-w-full" type="number" name="cedula" id="cedula" placeholder="Número de Cedula del Estudiante" :value="old('cedula')" required  />
          </div>
        </div>

        <div class="sm:col-span-2">
          <div class="mt-2">
          <x-label>Fecha de Nacimiento</x-label>
            <x-input-form class="sm:max-w-full" type="date" name="fecha-nacimiento" id="fecha-nacimiento" :value="old('fecha-nacimiento')" required  />
          </div>
        </div>

        <div class="sm:col-span-2 sm:col-start-1">
          <div class="mt-2">
          <x-label>Correo / Email</x-label>
            <x-input-form type="email" name="email" id="email" placeholder="Dirección de Correo Electrónico del Estudiante" :value="old('email')" required  />
          </div>
        </div>

        <div class="sm:col-span-1">
          <div class="mt-2">
          <x-label>Teléfono</x-label>
            <x-input-form type="tel" name="telefono" id="telefono" placeholder="Teléfono del Estudiante" :value="old('telefono')" required  />
          </div>
        </div>

        <div class="sm:col-span-2">
          <div class="mt-2">
          <x-label>Dirección</x-label>
            <x-input-form type="text" name="direccion" id="direccion" placeholder="Dirección del Estudiante" :value="old('direccion')" required  />
          </div>
        </div>

        <div class="sm:col-span-1">
          <div class="mt-2">
          <x-label>Ciudad</x-label>
            <x-input-form type="text" name="city" id="city" placeholder="Ciudad o Pueblo del Estudiante" :value="old('city')" required  />
          </div>
        </div>

        <div class="sm:col-span-2 sm:col-start-1">
          <div class="mt-2">
          <x-label>Carrera a Estudiar</x-label>
            <x-select-form class="sm:max-w-full" name="carrera" id="carrera">
              <option>Administración</option>
              <option>Informática</option>
              <option>Maquinaria Pesada</option>
            </x-select-form>
          </div>
        </div>
        <div class="sm:col-span-2">
          <div class="mt-2">
          <x-label>Tramo y Trayecto</x-label>
            <x-select-form class="sm:max-w-full" id="trayecto" name="trayecto">
                <option value="trayecto-inicial">Trayecto Inicial</option>
                <optgroup label="Trayecto I">
                    <option value="trayecto-uno-tramo-1">Tramo I</option>
                    <option value="trayecto-uno-tramo-2">Tramo II</option>
                    <option value="trayecto-uno-tramo-3">Tramo III</option>
                </optgroup>
                <optgroup label="Trayecto II">
                    <option value="trayecto-dos-tramo-4">Tramo IV</option>
                    <option value="trayecto-tres-tramo-5">Tramo V</option>
                    <option value="trayecto-cuatro-tramo-6">Tramo VI</option>
                </optgroup>
                <optgroup label="Trayecto III">
                    <option value="trayecto-tres-tramo-7">Tramo VII</option>
                    <option value="trayecto-tres-tramo-8">Tramo VIII</option>
                    <option value="trayecto-cuatro-tramo-9">Tramo IX</option>
                </optgroup>
                <optgroup label="Trayecto IV">
                    <option value="trayecto-cuatro-tramo-10">Tramo X</option>
                    <option value="trayecto-cuatro-tramo-11">Tramo XI</option>
                    <option value="trayecto-cuatro-tramo-12">Tramo XII</option>
                </optgroup>
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

