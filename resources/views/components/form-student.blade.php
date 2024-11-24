<form>
  <div class="space-y-12 p-[21px]">
    <div class="border-gray-900/10 pb-12">
      <h2 class="text-base/7 font-semibold text-gray-900">Nuevo Estudiante</h2>
      <p class="mt-1 text-sm/6 text-gray-600">Rellene todas las casillas para registrar al nuevo estudiante en la institución</p>

    <div class="border-gray-900/10 pb-12">
      <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
        <div class="sm:col-span-3">
          <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Nombre Completo</label>
          <div class="mt-2">
            <input type="text" name="primer-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" placeholder="Primer nombre">
            <input type="text" name="segundo-name" id="first-name" autocomplete="given-name" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" placeholder="Segundo Nombre">
          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="last-name" class="block text-sm/6 font-medium text-gray-900">Apellido Completo</label>
          <div class="mt-2">
            <input type="text" name="primer-apellido" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" placeholder="Primer Apellido">
            <input type="text" name="segundo-apellido" id="last-name" autocomplete="family-name" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" placeholder="Segundo Apellido">
          </div>
        </div>

        <div class="mt-2">
        <label for="trayecto" class="block text-sm/6 font-medium text-gray-900">Genero / Sexo</label>
            <div class="flex items-center gap-x-3">
            <select id="trayecto" name="trayecto" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
            </select>
            </div>
        </div>


        <div class="sm:col-span-4">
          <label for="cedula" class="block text-sm/6 font-medium text-gray-900">Cedula de Identidad</label>
          <div class="mt-2">
            <select id="nacionalidad" name="pnf" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
                <option value="">Venezolano(a)</option>
                <option value="">Extranjero(a)</option>

            </select>
            <input id="email" name="cedula" type="number" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6" placeholder="Número de la Cedula">
          </div>
        </div>


        <div class="sm:col-span-3">
          <label for="email" class="block text-sm/6 font-medium text-gray-900">Correo / Email</label>
          <div class="mt-2">
            <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" placeholder="Correo Electronico del Estudiante">
          </div>
        </div>

        <div class="sm:col-span-3">
          <label for="direccion" class="block text-sm/6 font-medium text-gray-900">Dirección</label>
          <div class="mt-2">
            <input id="direccion" name="direccion" type="text" autocomplete="country" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" placeholder="Dirección">
          </div>
        </div>


        <div class="sm:col-span-2 sm:col-start-1">
          <label for="city" class="block text-sm/6 font-medium text-gray-900">Ciudad</label>
          <div class="mt-2">
            <input type="text" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" placeholder="Ciudad">
          </div>
        </div>

        <div class="sm:col-span-2">
          <label for="region" class="block text-sm/6 font-medium text-gray-900">Carrera a Estudiar</label>
          <div class="mt-2">
            <select id="carrera" name="pnf" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
              <option>Administración</option>
              <option>Informática</option>
              <option>Maquinaria Pesada</option>
            </select>
          </div>
        </div>
        <div class="sm:col-span-2">
          <label for="trayecto" class="block text-sm/6 font-medium text-gray-900">Tramo y Trayecto</label>
          <div class="mt-2">
            <select id="trayecto" name="trayecto" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm/6">
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
            </select>
          </div>
        
        </div>
      </div>
    </div>
  <div class="mt-6 flex items-center justify-end gap-x-6">
    <button type="reset" class="rounded-md bg-[#d84242] px-3 py-2 text-sm/6 font-semibold text-white shadow-sm hover:bg-[#670f0f] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Limpiar <i class="fa-solid fa-eraser"></i></button>
    <button type="submit" class="rounded-md bg-[#4272d8] px-3 py-[0.7rem] text-sm font-semibold text-white shadow-sm hover:bg-[#0f2167] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Registrar <i class="fa-solid fa-floppy-disk"></i></button>
  </div>
</form>

