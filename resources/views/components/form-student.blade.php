<form method="POST" action="/registro-estudiante">
    @csrf
    @props(['courses', 'trayectos', 'nucleos', 'secciones', 'user', 'nivelsocial', 'titulo'])
    <div class="space-y-12 p-[21px]">
        <div class="border-gray-900/10 pb-12 mx-auto max-w-[700px]">
            <p class="mt-7 text-xl font-inter text-gray-400">Rellene todas las casillas para registrar al nuevo
                estudiante en la institución</p>

            <div class="border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-3" id="datosPersonales">
                    <div class="md:col-span-3">
                        <div class="">
                            <x-label for="first-name">Nombre Completo</x-label>
                            <div class="sm:flex rounded-lg">
                                <x-input-form type="text" maxlength="80" name="primer_name" id="first-name"
                                    placeholder="Primer Nombre (Obligatorio)" :value="old('primer_name')" required
                                    class="sm:rounded-r-none"
                                    autocomplete="off" />
                                <x-input-form type="text" maxlength="80" name="segundo_name" id="first-name"
                                    class="sm:rounded-l-none"
                                    placeholder="Segundo Nombre" :value="old('segundo_name')" autocomplete="off" />
                            </div>
                            <x-input-error name="primer_name" />
                            <x-input-error name="segundo_name" />
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <div class="mt-2">
                            <x-label for="last-name">Apellido Completo</x-label>
                            <div class="sm:flex rounded-lg">
                                <x-input-form type="text" maxlength="80" name="primer_apellido" id="last-name"
                                    placeholder="Primer Apellido (Obligatorio)" :value="old('primer_apellido')" required
                                    class="sm:rounded-r-none"
                                    autocomplete="off" />
                                <x-input-form type="text" maxlength="80" name="segundo_apellido" id="last-name"
                                    class="sm:rounded-l-none"
                                    placeholder="Segundo Apellido" :value="old('segundo_apellido')" autocomplete="off" />
                            </div>
                            <x-input-error name="primer_apellido" />
                            <x-input-error name="segundo_apellido" />
                        </div>
                    </div>
                    <div class="md:col-span-1 md:col-start-1">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Nacionalidad</x-label>
                            <x-select-form class="sm:max-w-full" id="nacionalidad" name="nacionalidad">
                                <option value="{{ encrypt('VE') }}">Venezolano(a)</option>
                                <option value="{{ encrypt('EX') }}">Extranjero(a)</option>
                            </x-select-form>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label for="cedula" class="after:content-['*'] after:text-red-400">Cédula de Identidad</x-label>
                            <x-input-form class="sm:max-w-full" type="number" name="cedula" id="cedula"
                                placeholder="Número de Cedula" :value="old('cedula')" required
                                autocomplete="off" />
                            <x-input-error name="cedula" />
                        </div>
                    </div>
                    <div class="md:col-span-1 mt-2">
                        <x-label class="after:content-['*'] after:text-red-400">Genero / Sexo</x-label>
                        <div class="flex items-center">
                            <x-select-form class="sm:max-w-full" name="genero" :value="old('genero')">
                                <option value="{{ encrypt('masculino') }}">Masculino</option>
                                <option value="{{ encrypt('femenino') }}">Femenino</option>
                            </x-select-form>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label for="fecha-nacimiento" class="after:content-['*'] after:text-red-400">Fecha de Nacimiento</x-label>
                            <x-input-form class="sm:max-w-full" type="date" name="fecha_nacimiento"
                                id="fecha-nacimiento" :value="old('fecha_nacimiento')" required />
                            <x-input-error name="fecha_nacimiento" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="">
                            <x-label for="nacimiento_city" class="after:content-['*'] after:text-red-400">Ciudad De Nacimiento</x-label>
                            <x-input-form type="text" maxlength="80" name="nacimiento_city" id="nacimiento_city"
                                placeholder="Ciudad/Pueblo De Nacimiento" :value="old('nacimiento_city')"
                                autocomplete="off" />
                            <x-input-error name="nacimiento_city" />
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <x-label class="after:content-['*'] after:text-red-400" for="civil">Estado Civil</x-label>
                        <div class="flex items-center">
                            <x-select-form class="sm:max-w-full" name="civil" :value="old('civil')" id="civil">
                                <option value="{{ encrypt('s') }}">Soltero/a</option>
                                <option value="{{ encrypt('c') }}">Casado/a</option>
                                <option value="{{ encrypt('d') }}">Divorciado/a</option>
                                <option value="{{ encrypt('v') }}">Viudo/a</option>
                            </x-select-form>
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400" for="email">Correo / Email</x-label>
                            <x-input-form type="email" maxlength="100" name="email" id="email"
                                placeholder="Dirección de Correo Electrónico" :value="old('email')"
                                required
                                autocomplete="off" />
                            <x-input-error name="email" />
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400" for="telefono">Teléfono</x-label>
                            <x-input-form type="tel" maxlength="11" name="telefono" id="telefono"
                                placeholder="Teléfono Personal" :value="old('telefono')" autocomplete="off" />
                            <x-input-error name="telefono" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label for="telefono">Teléfono De Habitación (Opcional)</x-label>
                            <x-input-form type="tel" maxlength="11" name="telefonohabitacion" id="telefonohabitacion"
                                placeholder="Teléfono De Casa/Habitacion/Extra" :value="old('telefonohabitacion')" autocomplete="off" />
                            <x-input-error name="telefonohabitacion" />
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <div class="mt-2">
                            <x-label for="city" class="after:content-['*'] after:text-red-400">Ciudad</x-label>
                            <x-input-form type="text" maxlength="43" name="city" id="city"
                                placeholder="Ciudad/Pueblo Donde Vive" :value="old('city')" required
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label for="direccion" class="after:content-['*'] after:text-red-400">Dirección</x-label>
                            <x-input-form type="text" maxlength="80" name="direccion" id="direccion"
                                placeholder="Dirección Donde Vive" :value="old('direccion')" required autocomplete="off" />
                            <x-input-error name="direccion" />
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <div class="mt-2">
                            <x-label for="consejo" class="after:content-['*'] after:text-red-400">Consejo Comunal</x-label>
                            <x-input-form type="text" maxlength="80" name="consejo" id="concejo"
                                placeholder="Nombre Del Consejo Comunal" :value="old('consejo')"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label for="comuna" class="after:content-['*'] after:text-red-400">Nombre De Su Comuna</x-label>
                            <x-input-form type="text" maxlength="80" name="comuna" id="comuna"
                                placeholder="Nombre De La Comuna" :value="old('comuna')"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <div class="mt-2 flex items-center">
                            <x-input-check type="checkbox" name="discapacidadChe" id="discapacidadCheck" />
                            <x-label for="discapacidadCheck" class="select-none">Posee Alguna Discapacidad</x-label>
                        </div>
                    </div>
                    <div class="md:col-span-3 hidden" id="discapacidadInput">
                        <div class="mb-7">
                            <x-label for="discapacidad" class="mt-none after:content-['*'] after:text-red-400">Especifíque Su Discapacidad</x-label>
                            <x-input-form type="text" maxlength="80" name="discapacidad" id="discapacidad"
                                placeholder="Ingrese Su Discapacidad" :value="old('discapacidad')"
                                autocomplete="off" />
                        </div>
                    </div>
                    <script>
                        const inputDisc = document.getElementById('discapacidadInput');
                        let checkDisc = document.getElementById('discapacidadCheck');
                            checkDisc.addEventListener('change', ()=>{
                            if(checkDisc.checked){
                                inputDisc.classList.remove('hidden');
                            } else {
                                inputDisc.classList.add('hidden');
                            }
                        });
                    </script>
                    <div class="md:col-span-3">
                        <div class="mt-2 flex items-center">
                            <x-input-check type="checkbox" name="deportista" id="deportistaCheck" />
                            <x-label for="deportistaCheck" class="select-none">Eres Deportista De Alto Rendimiento</x-label>
                        </div>
                    </div>
                    <div class="md:col-span-3 hidden" id="disciplinaInput">
                        <div class="mb-7">
                            <x-label for="disciplina" class="mt-none after:content-['*'] after:text-red-400">Especifíque Su Disciplina</x-label>
                            <x-input-form type="text" maxlength="80" name="disciplina" id="disciplina"
                                placeholder="Ingrese Su Disciplina" :value="old('disciplina')"
                                autocomplete="off" />
                        </div>
                    </div>
                    <script>
                        const inputDisci = document.getElementById('disciplinaInput');
                        let checkDepor = document.getElementById('deportistaCheck');
                            checkDepor.addEventListener('change', ()=>{
                            if(checkDepor.checked){
                                inputDisci.classList.remove('hidden');
                            } else {
                                inputDisci.classList.add('hidden');
                            }
                        });
                    </script>
                    <div class="md:col-span-3 flex justify-between mt-12">
                        <x-button type="reset" class="bg-[#d84242] hover:bg-[#670f0f]" id="atras2"><i class="fas fa-eraser !mr-2"></i>Limpiar</x-button>
                        <x-button type="button" id="siguiente2">Siguiente<i class="fas fa-arrow-right !mr-0 !ml-2"></i></x-button>
                    </div>
                </div>
            {{-- Datos Academicos de Procedencia --}}
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-3 hidden" id="datosProcedencia">
                    <div class="md:col-span-1 md:col-start-1">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Título</x-label>
                            <option value="none" selected disabled hidden>{{ ucwords('seleccione el título') }}</option>
                            <x-select-form class="sm:max-w-full" id="titulo" name="titulo">
                                @foreach ($titulo as $titulos)
                                    <option value="{{ $titulos->id }}">{{ $titulos->titulo }}</option>
                                @endforeach
                            </x-select-form>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400" for="mencion">Mención/Especialidad</x-label>
                            <x-input-form class="sm:max-w-full" maxlength="30" type="text" name="mencion" id="mencion"
                                placeholder="Especialidad Que Te Graduaste, Ej. Ciencias" :value="old('mencion')"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label for="institucion" class="after:content-['*'] after:text-red-400">Institución</x-label>
                            <x-input-form type="text" maxlength="80" name="institucion" id="institucion"
                                placeholder="Institución Donde Te Graduaste" :value="old('institucion')"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <div class="mt-2">
                            <x-label for="cityinstitucion" class="after:content-['*'] after:text-red-400">Ciudad</x-label>
                            <x-input-form type="text" maxlength="43" name="cityinstitucion" id="cityinstitucion"
                                placeholder="Ciudad De La Institución" :value="old('cityinstitucion')"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label for="fecha_grado" class="after:content-['*'] after:text-red-400">Fecha Del Grado</x-label>
                            <x-input-form class="sm:max-w-full" type="date" name="fecha_grado"
                                id="fecha_grado" :value="old('fecha_grado')" />
                        </div>
                    </div>
                    <div class="md:col-span-1 mt-2">
                        <x-label for="promedio" class="after:content-['*'] after:text-red-400">Promedio De OPSU</x-label>
                        <div class="flex items-center">
                            <x-select-form class="sm:max-w-full" name="promedio" id="promedio" :value="old('promedio')">
                                <option value="none" selected disabled hidden>{{ ucwords('seleccione el promedio') }}</option>
                                @for($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </x-select-form>
                        </div>
                    </div>
                    {{-- Datos Socioeconomicos --}}
                    <div class="md:col-span-3">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400" for="nivel_social">Nivel Socio Económico</x-label>
                            <x-select-form class="sm:max-w-full" id="nivel_social" name="nivel_social">
                                @foreach ($nivelsocial as $social)
                                    <option value="{{ $social->id }}">{{ $social->socioeconomico }}</option>
                                @endforeach
                            </x-select-form>
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <div class="mt-2 flex items-center">
                            <x-input-check type="checkbox" name="trabajaCheck" id="trabajaCheck" />
                            <x-label for="trabajaCheck" class="select-none">Trabaja</x-label>
                        </div>
                    </div>
                    <div class="md:col-span-3 hidden" id="trabajaInput">
                        <div class="mb-7">
                            <x-label for="trabaja" class="mt-none after:content-['*'] after:text-red-400">Lugar De Trabajo</x-label>
                            <x-input-form type="text" maxlength="43" name="trabaja" id="trabaja"
                                placeholder="Ingrese El Lugar De Trabajo" :value="old('trabaja')"
                                autocomplete="off" />
                        </div>
                    </div>
                    <script>
                        const inputTra = document.getElementById('trabajaInput');
                        let checkTra = document.getElementById('trabajaCheck');
                            checkTra.addEventListener('change', ()=>{
                            if(checkTra.checked){
                                inputTra.classList.remove('hidden');
                            } else {
                                inputTra.classList.add('hidden');
                            }
                        });
                    </script>
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
                            <x-label class="after:content-['*'] after:text-red-400">Tramo y Trayecto</x-label>
                            <x-select-form class="sm:max-w-full" name="tramo_trayecto_id">
                                @foreach ($trayectos as $trayecto)
                                    <optgroup label="{{ $trayecto->trayectos }}">
                                        @foreach ($trayecto->tramos as $tramos)
                                            <option value="{{ $tramos->pivot->id }}">{{ $tramos->tramos }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </x-select-form>
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
                    <div class="carreratramonucleo">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Agregar Código</x-label>
                            <x-input-form name="codigo" type="number" autocomplete="off"
                                placeholder="Agregar código al estudiante" :value="old('codigo')" />
                        </div>
                    </div>
                    <div class="md:col-span-3 flex justify-between mt-12">
                        <x-button type="button" id="atras3"><i class="fas fa-arrow-left !mr-2"></i>Regresar</x-button>
                        <x-button type="submit" id="siguiente3">Finalizar<i class="fas fa-save !mr-0 !ml-2"></i></x-button>
                    </div>
                </div>
            </div>
        </div>
            @if (!$errors->all())
                <x-dialog-modal-correct class="transition-all">
                    <x-slot:botones>
                        Cerrar
                    </x-slot:botones>
                </x-dialog-modal-correct>
            @else
                <x-dialog-modal-errors class="transition-all">
                    <x-slot:botones>
                        Cerrar
                    </x-slot:botones>
                </x-dialog-modal-errors>
            @endif
</form>
<script>
    const personal = document.getElementById('datosPersonales');
    const procedencia = document.getElementById('datosProcedencia');
    const seccion2 = document.getElementById('siguiente2');
    const atras3 = document.getElementById('atras3');

    seccion2.addEventListener('click', () => {
        personal.classList.add('hidden');
        procedencia.classList.remove('hidden');
    });
    atras3.addEventListener('click', () => {
        personal.classList.remove('hidden');
        procedencia.classList.add('hidden');
    });
</script>
