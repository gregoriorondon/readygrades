<form method="POST" action="/registro-estudiante">
    @csrf
    {{-- @if ($errors->any()) --}}
    {{-- <div class="alert alert-danger"> --}}
    {{--     <ul> --}}
    {{--         @foreach ($errors->all() as $error) --}}
    {{--             <li>{{ $error }}</li> --}}
    {{--         @endforeach --}}
    {{--     </ul> --}}
    {{-- </div> --}}
    {{-- @endif --}}
  <div class="space-y-12 p-[21px]">
    <div class="border-gray-900/10 pb-12">
      <p class="mt-7 text-xl font-inter text-gray-400">Rellene todas las casillas para registrar al nuevo estudiante en la institución</p>

    <div class="border-gray-900/10 pb-12">
      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <div class="mt-2">
          <x-label>Nombre Completo</x-label>
            <x-input-form type="text" name="primer_name" id="first-name" placeholder="Primer Nombre" :value="old('primer_name')" required />
            <x-input-form type="text" name="segundo_name" id="first-name" placeholder="Segundo Nombre" :value="old('segundo_name')" />
          </div>
        </div>

        <div class="sm:col-span-3">
          <div class="mt-2">
          <x-label>Apellido Completo</x-label>
            <x-input-form type="text" name="primer_apellido" id="last-name" placeholder="Primer Apellido" :value="old('primer_apellido')" required  />
            <x-input-form type="text" name="segundo_apellido" id="last-name" placeholder="Segundo Apellido" :value="old('segundo_apellido')" />
          </div>
        </div>

        <div class="sm:col-span-1 mt-2 sm:col-start-1">
        <x-label>Genero / Sexo</x-label>
            <div class="flex items-center">
            <x-select-form class="sm:max-w-full" name="genero" :value="old('genero')">
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
            <x-input-error name="cedula" />
          </div>
        </div>

        <div class="sm:col-span-2">
          <div class="mt-2">
          <x-label>Fecha de Nacimiento</x-label>
            <x-input-form class="sm:max-w-full" type="date" name="fecha_nacimiento" id="fecha-nacimiento" :value="old('fecha_nacimiento')" required  />
          </div>
        </div>

        <div class="sm:col-span-2 sm:col-start-1">
          <div class="mt-2">
          <x-label>Correo / Email</x-label>
            <x-input-form type="email" name="email" id="email" placeholder="Dirección de Correo Electrónico del Estudiante" :value="old('email')"  />
          </div>
        </div>

        <div class="sm:col-span-1">
          <div class="mt-2">
          <x-label>Teléfono</x-label>
            <x-input-form type="tel" name="telefono" id="telefono" placeholder="Teléfono del Estudiante" :value="old('telefono')"  />
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

<div class="gap-x-6 gap-y-8 sm:grid-cols-6 divcarreratramonucleo">
        <div class="carreratramonucleo">
          <div class="mt-2">

          <x-label>Carrera a Estudiar</x-label>
          @props(['courses', 'trayectos', 'nucleos'])
          <x-select-form class="sm:max-w-full" name="carrera_id" id="carreras_id" >
                @foreach($courses as $carrera)
                    <option value="{{ $carrera->id }}">{{ $carrera->carrera }}</option>
                @endforeach
            </x-select-form>
          </div>
        </div>
        <div class="carreratramonucleo">
          <div class="mt-2">
          <x-label>Tramo y Trayecto</x-label>
            <x-select-form class="sm:max-w-full" name="tramo_id">
                @foreach($trayectos as $trayecto)
                    <optgroup label="{{ $trayecto->trayectos }}">
                        @foreach($trayecto->tramos as $tramos)
                            <option value="{{ $tramos->id }}">{{ $tramos->tramos }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </x-select-form>
          </div>
        </div>
        <div class="carreratramonucleo">
          <div class="mt-2">
          <x-label>Núcleos</x-label>
            <x-select-form class="sm:max-w-full" name="nucleo_id">
                @foreach($nucleos as $nucleo)
                    <option value="{{ $nucleo->id }}">{{ $nucleo->nucleo }}</option>
                @endforeach
            </x-select-form>
          </div>
        </div>

      </div>
    </div>
</div>
  <div class="mt-6 flex items-center justify-end gap-x-6">
    <button type="reset" class="font-inter font-extrabold rounded-md bg-[#d84242] px-3 py-2 text-sm/6 font-semibold text-white shadow-sm hover:bg-[#670f0f] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Limpiar <i class="fa-solid fa-eraser m-0"></i></button>
    <button type="submit" class="font-inter font-extrabold rounded-md bg-ready px-3 py-[0.7rem] text-sm font-semibold text-white shadow-sm hover:bg-[#0f2167] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Registrar <i class="fa-solid fa-floppy-disk m-0"></i></button>
  </div>
      <x-dialog-modal-errors class="transition-all">
          <x-slot:botones>
              Cerrar
          </x-slot:botones>
      </x-dialog-modal-errors>
</form>

