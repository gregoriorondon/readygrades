<form method="POST" action="/cargar-notas">
    @csrf
    @props(['courses', 'nucleos', 'secciones', 'user', 'materias'])
    <div class="space-y-12 p-[21px]">
        <div class="border-gray-900/10 pb-12 mx-auto max-w-[700px]">
            <p class="mt-7 text-xl font-inter text-gray-400 uppercase">Rellene todas las casillas para registrar al nuevo estudiante en la institución</p>

            <div class="border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-3">
                    <div class="md:col-span-2 flex items-center">
                        <x-input-check type="checkbox" name="studentdata" id="student" :value="old('studentdata')" />
                        <x-label for="student" class="select-none">{{ ucwords('estudiante ya fué registrado') }}</x-label>
                    </div>

                    <div class="md:col-span-3" id="nombre">
                        <div class="mt-2">
                            <x-label>Nombre Completo</x-label>
                            <div class="sm:flex rounded-lg">
                                <x-input-form type="text" name="primer_name" id="first-name"
                                    placeholder="Primer Nombre (Obligatorio)" :value="old('primer_name')"
                                    class="sm:rounded-r-none"
                                    autocomplete="off" />
                                <x-input-form type="text" name="segundo_name" id="first-name"
                                    class="sm:rounded-l-none"
                                    placeholder="Segundo Nombre" value="{{ old('segundo_name') }}" autocomplete="off" />
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-3" id="apellido">
                        <div class="mt-2">
                            <x-label>Apellido Completo</x-label>
                            <div class="sm:flex rounded-lg">
                                <x-input-form type="text" name="primer_apellido" id="last-name"
                                    placeholder="Primer Apellido (Obligatorio)" :value="old('primer_apellido')"
                                    class="sm:rounded-r-none"
                                    autocomplete="off" />
                                <x-input-form type="text" name="segundo_apellido" id="last-name"
                                    class="sm:rounded-l-none"
                                    placeholder="Segundo Apellido" :value="old('segundo_apellido')" autocomplete="off" />
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-1 md:col-start-1">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Nacionalidad</x-label>
                            <x-select-form class="sm:max-w-full" id="nacionalidad" name="nacionalidad">
                                <option value="VE">Venezolano(a)</option>
                                <option value="EX">Extranjero(a)</option>
                            </x-select-form>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Cédula de Identidad</x-label>
                            <x-input-form class="sm:max-w-full" type="number" name="cedula" id="cedula"
                                placeholder="Número de Cedula del Estudiante" :value="old('cedula')"
                                autocomplete="off" />
                            <x-input-error name="cedula" />
                        </div>
                    </div>

                    <div class="md:col-span-1 mt-2" id="genero">
                        <x-label class="after:content-['*'] after:text-red-400">Genero / Sexo</x-label>
                        <div class="flex items-center">
                            <x-select-form class="sm:max-w-full" name="genero" :value="old('genero')">
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                            </x-select-form>
                        </div>
                    </div>

                    <div class="md:col-span-2" id="nacimiento">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Fecha de Nacimiento</x-label>
                            <x-input-form class="sm:max-w-full" type="date" name="fecha_nacimiento"
                                id="fecha-nacimiento" :value="old('fecha_nacimiento')"  />
                        </div>
                    </div>

                    <div class="md:col-span-2 md:col-start-1" id="email">
                        <div class="mt-2">
                            <x-label>Correo / Email</x-label>
                            <x-input-form type="email" name="email" id="email"
                                placeholder="Dirección de Correo Electrónico del Estudiante" :value="old('email')"
                                autocomplete="off" />
                        </div>
                    </div>

                    <div class="md:col-span-1" id="telefono">
                        <div class="mt-2">
                            <x-label>Teléfono</x-label>
                            <x-input-form type="tel" name="telefono" id="telefono"
                                placeholder="Teléfono del Estudiante" :value="old('telefono')" autocomplete="off" />
                        </div>
                    </div>

                    <div class="md:col-span-2" id="dir">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Dirección</x-label>
                            <x-input-form type="text" name="direccion" id="direccion"
                                placeholder="Dirección del Estudiante" :value="old('direccion')"  autocomplete="off" />
                        </div>
                    </div>

                    <div class="md:col-span-1" id="city">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Ciudad</x-label>
                            <x-input-form type="text" name="city" id="city"
                                placeholder="Ciudad o Pueblo del Estudiante" :value="old('city')"
                                autocomplete="off" />
                        </div>
                    </div>

                    <div class="carreratramonucleo">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Carrera a Estudiar</x-label>
                            <x-select-form class="sm:max-w-full" name="carrera_id" id="carreras_id">
                                @foreach ($courses as $carrera)
                                    <option value="{{ $carrera->id }}">{{ $carrera->carrera }}</option>
                                @endforeach
                            </x-select-form>
                        </div>
                    </div>

                    <div class="carreratramonucleo">
                        <div class="mt-2">
                        <x-label class="after:content-['*'] after:text-red-400">Materia</x-label>
                        <x-select-form class="sm:max-w-full" name="materia_id">
                            @foreach ($materias as $materia)
                                <option value="{{ $materia->id }}">
                                    {{ mb_strtoupper(trim($materia->codigo . ' | ' . $materia->materia), 'UTF-8') }}
                                </option>
                                </optgroup>
                            @endforeach
                        </x-select-form>
                        </div>
                    </div>

                    <div class="carreratramonucleo">
                        <div class="mt-2">
                        <x-label class="after:content-['*'] after:text-red-400">Definitiva</x-label>
                        <x-select-form name="definitiva" class="sm:max-w-full" id="definitiva" :value="old('definitiva')">
                            <option value="">{{ ucwords('seleccione') }}</option>
                            @for ($j = 1; $j <= 20; $j++)
                                <option value="{{ $j }}">
                                    {{ $j . ' pts ' }}</option>
                            @endfor
                        </x-select-form>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Nombre Del Periodo</x-label>
                            <x-input-form type="text" name="periodo_name" id="periodo"
                                placeholder="Periodo Del Estudiante" :value="old('periodo_name')" required autocomplete="off" />
                        </div>
                    </div>

                    <div class="md:col-span-1">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Fecha Periodo</x-label>
                            <x-input-form class="sm:max-w-full" type="date" name="fecha_periodo"
                                id="fecha-nacimiento" :value="old('fecha_periodo')" required />
                        </div>
                    </div>

                    <div class="carreratramonucleo">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Núcleos</x-label>
                            @cannot('root')
                                <x-select-form class="sm:max-w-full text-gray-400 cursor-not-allowed" name="nucleo_id"
                                    title="{{ ucwords('sólo puedes asignar el núcleo en donde estas registrado(a)') }}">
                                    <option type="numeric" value="{{ $user->nucleos->id }}">{{ $user->nucleos->nucleo }}</option>
                                </x-select-form>
                            @endcannot
                            @can('root')
                                <x-select-form class="sm:max-w-full" name="nucleo_id">
                                    @foreach ($nucleos as $nucleo)
                                        <option value="{{ $nucleo->id }}">{{ $nucleo->nucleo }}</option>
                                    @endforeach
                                </x-select-form>
                            @endcan
                        </div>
                    </div>

                    <div class="carreratramonucleo">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Sección</x-label>
                            <x-select-form class="sm:max-w-full" name="seccion_id">
                                @foreach ($secciones as $seccion)
                                    <option value="{{ $seccion->id }}">{{ $seccion->seccion }}</option>
                                @endforeach
                            </x-select-form>
                        </div>
                    </div>

                    <div class="carreratramonucleo" id="codigo">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Agregar Código</x-label>
                            <x-input-form name="codigo" type="number" autocomplete="off"
                                placeholder="Agregar código al estudiante" :value="old('codigo')" />
                        </div>
                    </div>

                    <div class="md:col-span-2 flex items-center hidden" id="carrera">
                        <x-input-check type="checkbox" name="studentcareer" id="carrerain" :value="old('studentdata')" />
                        <x-label for="carrerain" class="select-none">{{ ucwords('inscrito en la carrera') }}</x-label>
                    </div>
                </div>
            </div>
        <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="reset"
            class="font-inter font-extrabold rounded-md bg-[#d84242] px-3 py-2 text-sm/6 font-semibold text-white shadow-sm hover:bg-[#670f0f] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Limpiar
            <i class="fa-solid fa-eraser m-0"></i>
        </button>
        <button type="submit"
            class="font-inter font-extrabold rounded-md bg-ready px-3 py-[0.7rem] text-sm font-semibold text-white shadow-sm hover:bg-[#0f2167] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Registrar
            <i class="fa-solid fa-floppy-disk m-0"></i>
        </button>
    </div>
    <x-error-and-correct-dialog />
</form>
<script>
    const nombre = document.getElementById('nombre');
    const apellido = document.getElementById('apellido');
    const genero = document.getElementById('genero');
    const nacimiento = document.getElementById('nacimiento');
    const correo = document.getElementById('email');
    const telefono = document.getElementById('telefono');
    const direccion = document.getElementById('dir');
    const ciudad = document.getElementById('city');
    const codigo = document.getElementById('codigo');
    const carrera = document.getElementById('carrera');
    let student = document.getElementById('student');
    student.addEventListener('change', ()=>{
        if(student.checked){
            nombre.classList.add('hidden');
            apellido.classList.add('hidden');
            genero.classList.add('hidden');
            nacimiento.classList.add('hidden');
            correo.classList.add('hidden');
            telefono.classList.add('hidden');
            direccion.classList.add('hidden');
            ciudad.classList.add('hidden');
            codigo.classList.add('hidden');
            carrera.classList.remove('hidden');
        } else {
            nombre.classList.remove('hidden');
            apellido.classList.remove('hidden');
            genero.classList.remove('hidden');
            nacimiento.classList.remove('hidden');
            correo.classList.remove('hidden');
            telefono.classList.remove('hidden');
            direccion.classList.remove('hidden');
            ciudad.classList.remove('hidden');
            codigo.classList.remove('hidden');
            carrera.classList.add('hidden');
        }
    });
</script>
