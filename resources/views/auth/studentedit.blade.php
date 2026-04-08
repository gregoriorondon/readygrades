<x-dashboard>
    <x-slot:titulo>{{ ucwords('editar datos de ') . $estudiantes->primer_name }}</x-slot:titulo>
    <x-title-section-admin>{{ ucwords('editar datos de ') . $estudiantes->primer_name . ' ' . $estudiantes->primer_apellido }}</x-title-section-admin>
<div>
    <div class="space-y-12 p-[21px]">
        <form method="POST" action="{{ route('students.save') }}">
            @csrf
            <div class="border-gray-900/10 pb-12">
                <p class="mt-7 text-xl font-inter text-gray-400">
                    {{ mb_convert_case('cambie únicamente los datos que desea corregir', MB_CASE_TITLE, 'UTF-8') }}
                </p>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-3" id="datosPersonales">
                    <div class="md:col-span-3">
                        <div class="">
                            <x-label for="first-name">Nombre Completo</x-label>
                            <div class="sm:flex rounded-lg">
                                <x-input-form type="text" maxlength="80" name="primer_name" id="first-name"
                                    placeholder="Primer Nombre (Obligatorio)"
                                    value="{{ $estudiantes->primer_name }}" required
                                    class="sm:rounded-r-none"
                                    autocomplete="off" />
                                <x-input-form type="text" maxlength="80" name="segundo_name" id="first-name"
                                    class="sm:rounded-l-none"
                                    placeholder="Segundo Nombre" value="{{ $estudiantes->segundo_name }}" autocomplete="off" />
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
                                    placeholder="Primer Apellido (Obligatorio)" value="{{ $estudiantes->primer_apellido }}" required
                                    class="sm:rounded-r-none"
                                    autocomplete="off" />
                                <x-input-form type="text" maxlength="80" name="segundo_apellido" id="last-name"
                                    class="sm:rounded-l-none"
                                    placeholder="Segundo Apellido" value="{{ $estudiantes->segundo_apellido }}" autocomplete="off" />
                            </div>
                            <x-input-error name="primer_apellido" />
                            <x-input-error name="segundo_apellido" />
                        </div>
                    </div>
                    <div class="md:col-span-1 md:col-start-1">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400">Nacionalidad</x-label>
                            <x-select-form class="sm:max-w-full" id="nacionalidad" name="nacionalidad">
                                <option value="{{ encrypt('VE') }}" {{ $estudiantes->nacionalidad == 'VE' ? 'selected' : '' }}>Venezolano(a)</option>
                                <option value="{{ encrypt('EX') }}" {{ $estudiantes->nacionalidad == 'EX' ? 'selected' : '' }}>Extranjero(a)</option>
                            </x-select-form>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label for="cedula" class="after:content-['*'] after:text-red-400">Cédula de Identidad</x-label>
                            <x-input-form class="sm:max-w-full" type="number" name="cedula" id="cedula"
                                placeholder="Número de Cedula" value="{{ $estudiantes->cedula }}" required
                                autocomplete="off" />
                            <x-input-error name="cedula" />
                        </div>
                    </div>
                    <div class="md:col-span-1 mt-2">
                        <x-label class="after:content-['*'] after:text-red-400">Genero / Sexo</x-label>
                        <div class="flex items-center">
                            <x-select-form class="sm:max-w-full" name="genero" value="{{ $estudiantes->genero }}">
                                <option value="{{ encrypt('masculino') }}"{{ $estudiantes->genero == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="{{ encrypt('femenino') }}"{{ $estudiantes->genero == 'femenino' ? 'selected' : '' }}>Femenino</option>
                            </x-select-form>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label for="fecha-nacimiento" class="after:content-['*'] after:text-red-400">Fecha de Nacimiento</x-label>
                            <x-input-form class="sm:max-w-full" type="date" name="fecha_nacimiento"
                                id="fecha-nacimiento" value="{{ $estudiantes->fecha_nacimiento }}" required />
                            <x-input-error name="fecha_nacimiento" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="">
                            <x-label for="nacimiento_city" class="after:content-['*'] after:text-red-400">Ciudad De Nacimiento</x-label>
                            <x-input-form type="text" maxlength="80" name="nacimiento_city" id="nacimiento_city"
                                placeholder="Ciudad/Pueblo De Nacimiento" value="{{ $estudiantes->nacimiento_city }}"
                                autocomplete="off" />
                            <x-input-error name="nacimiento_city" />
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <x-label class="after:content-['*'] after:text-red-400" for="civil">Estado Civil</x-label>
                        <div class="flex items-center">
                            <x-select-form class="sm:max-w-full" name="civil" value="{{ $estudiantes->civil }}" id="civil">
                                <option value="{{ encrypt('s') }}" {{ $estudiantes->civil == 's' ? 'selected' : '' }}>Soltero/a</option>
                                <option value="{{ encrypt('c') }}" {{ $estudiantes->civil == 'c' ? 'selected' : '' }}>Casado/a</option>
                                <option value="{{ encrypt('d') }}" {{ $estudiantes->civil == 'd' ? 'selected' : '' }}>Divorciado/a</option>
                                <option value="{{ encrypt('v') }}" {{ $estudiantes->civil == 'v' ? 'selected' : '' }}>Viudo/a</option>
                            </x-select-form>
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400" for="email">Correo / Email</x-label>
                            <x-input-form type="email" maxlength="100" name="email" id="email"
                                placeholder="Dirección de Correo Electrónico" value="{{ $estudiantes->email }}"
                                required
                                autocomplete="off" />
                            <x-input-error name="email" />
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400" for="telefono">Teléfono</x-label>
                            <x-input-form type="tel" maxlength="11" name="telefono" id="telefono"
                                placeholder="Teléfono Personal" value="{{ $estudiantes->telefono }}" autocomplete="off" />
                            <x-input-error name="telefono" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label for="telefono">Teléfono De Habitación (Opcional)</x-label>
                            <x-input-form type="tel" maxlength="11" name="telefonohabitacion" id="telefonohabitacion"
                                placeholder="Teléfono De Casa/Habitacion/Extra" value="{{ $estudiantes->telefono2 }}" autocomplete="off" />
                            <x-input-error name="telefonohabitacion" />
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <div class="mt-2">
                            <x-label for="city" class="after:content-['*'] after:text-red-400">Ciudad</x-label>
                            <x-input-form type="text" maxlength="43" name="city" id="city"
                                placeholder="Ciudad/Pueblo Donde Vive" value="{{ $estudiantes->city }}" required
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label for="direccion" class="after:content-['*'] after:text-red-400">Dirección</x-label>
                            <x-input-form type="text" maxlength="80" name="direccion" id="direccion"
                                placeholder="Dirección Donde Vive" value="{{ $estudiantes->direccion }}" required autocomplete="off" />
                            <x-input-error name="direccion" />
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <div class="mt-2">
                            <x-label for="consejo" class="after:content-['*'] after:text-red-400">Consejo Comunal</x-label>
                            <x-input-form type="text" maxlength="80" name="consejo" id="concejo"
                                placeholder="Nombre Del Consejo Comunal" value="{{ $estudiantes->consejo }}"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label for="comuna" class="after:content-['*'] after:text-red-400">Nombre De Su Comuna</x-label>
                            <x-input-form type="text" maxlength="80" name="comuna" id="comuna"
                                placeholder="Nombre De La Comuna" value="{{ $estudiantes->comuna }}"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <div class="mt-2 flex items-center">
                            <x-input-check type="checkbox" name="discapacidadChe" id="discapacidadCheck" :checked="filled($estudiantes->discapacidad)" />
                            <x-label for="discapacidadCheck" class="select-none">Posee Alguna Discapacidad</x-label>
                        </div>
                    </div>
                    <div class="md:col-span-3 {{ $estudiantes->discapacidad ? '' : 'hidden' }}" id="discapacidadInput">
                        <div class="mb-7">
                            <x-label for="discapacidad" class="mt-none after:content-['*'] after:text-red-400">Especifíque Su Discapacidad</x-label>
                            <x-input-form type="text" maxlength="80" name="discapacidad" id="discapacidad"
                                placeholder="Ingrese Su Discapacidad" value="{{ $estudiantes->discapacidad }}"
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
                            <x-input-check type="checkbox" name="deportista" id="deportistaCheck" :checked="filled($estudiantes->disciplina)" />
                            <x-label for="deportistaCheck" class="select-none">Eres Deportista De Alto Rendimiento</x-label>
                        </div>
                    </div>
                    <div class="md:col-span-3 {{ $estudiantes->disciplina ? '' : 'hidden' }}" id="disciplinaInput">
                        <div class="mb-7">
                            <x-label for="disciplina" class="mt-none after:content-['*'] after:text-red-400">Especifíque Su Disciplina</x-label>
                            <x-input-form type="text" maxlength="80" name="disciplina" id="disciplina"
                                placeholder="Ingrese Su Disciplina" value="{{ $estudiantes->disciplina }}"
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
                        <x-button type="reset" class="bg-[#d84242] hover:bg-[#670f0f]" id="atras2" type="button"
                                    onclick="history.back()">Cancelar</x-button>
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
                                    <option value="{{ $titulos->id }}" {{ $estudiantes->title_student_temporal_id == $titulos->id ? 'selected' : '' }}>{{ $titulos->titulo }}</option>
                                @endforeach
                            </x-select-form>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label class="after:content-['*'] after:text-red-400" for="mencion">Mención/Especialidad</x-label>
                            <x-input-form class="sm:max-w-full" maxlength="30" type="text" name="mencion" id="mencion"
                                placeholder="Especialidad Que Te Graduaste, Ej. Ciencias" value="{{ $estudiantes->mencion }}"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label for="institucion" class="after:content-['*'] after:text-red-400">Institución</x-label>
                            <x-input-form type="text" maxlength="80" name="institucion" id="institucion"
                                placeholder="Institución Donde Te Graduaste" value="{{ $estudiantes->institucion }}"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <div class="mt-2">
                            <x-label for="cityinstitucion" class="after:content-['*'] after:text-red-400">Ciudad</x-label>
                            <x-input-form type="text" maxlength="43" name="cityinstitucion" id="cityinstitucion"
                                placeholder="Ciudad De La Institución" value="{{ $estudiantes->cityinstitucion }}"
                                autocomplete="off" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="mt-2">
                            <x-label for="fecha_grado" class="after:content-['*'] after:text-red-400">Fecha Del Grado</x-label>
                            <x-input-form class="sm:max-w-full" type="date" name="fecha_grado"
                                id="fecha_grado" value="{{ $estudiantes->fecha_grado }}" />
                        </div>
                    </div>
                    <div class="md:col-span-1 mt-2">
                        <x-label for="promedio" class="after:content-['*'] after:text-red-400">Promedio De OPSU</x-label>
                        <div class="flex items-center">
                            <x-select-form class="sm:max-w-full" name="promedio" id="promedio" value="{{ $estudiantes->promedio }}">
                                <option value="none" selected disabled hidden>{{ ucwords('seleccione el promedio') }}</option>
                                @for($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}" {{ $estudiantes->promedio == $i ? 'selected' : '' }}>{{ $i }}</option>
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
                                    <option value="{{ $social->id }}" {{ $estudiantes->students_socio_economico_id == $social->id ? 'selected' : '' }}>{{ $social->socioeconomico }}</option>
                                @endforeach
                            </x-select-form>
                        </div>
                    </div>
                    <div class="md:col-span-3">
                        <div class="mt-2 flex items-center">
                            <x-input-check type="checkbox" name="trabajaCheck" id="trabajaCheck" :checked="filled($estudiantes->trabaja)" />
                            <x-label for="trabajaCheck" class="select-none">Trabaja</x-label>
                        </div>
                    </div>
                    <div class="md:col-span-3 {{ $estudiantes->trabaja ? '' : 'hidden' }}" id="trabajaInput">
                        <div class="mb-7">
                            <x-label for="trabaja" class="mt-none after:content-['*'] after:text-red-400">Lugar De Trabajo</x-label>
                            <x-input-form type="text" maxlength="43" name="trabaja" id="trabaja"
                                placeholder="Ingrese El Lugar De Trabajo" value="{{ $estudiantes->trabaja }}"
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
                    @foreach ($estudianteData as $datos)
                        <div class="carreratramonucleo">
                            <div class="mt-2">
                                <x-label class="after:content-['*'] after:text-red-400">Sección Actual {{ $datos->carreras->carrera }}</x-label>
                                <x-select-form class="sm:max-w-full" name="seccion_id[{{ $datos->id }}]">
                                    @foreach ($datos->secciones_conteo as $secciones)
                                        <option value="{{ $secciones->id }}" {{ $datos->seccion_id === $secciones->id ? 'selected' : '' }}>{{ $secciones->seccion . ' (' . $secciones->conteo .' Veces usado)' }}</option>
                                    @endforeach
                                </x-select-form>
                            </div>
                        </div>
                    @endforeach
                    <div class="md:col-span-3 flex justify-between mt-12">
                        <x-button type="button" id="atras3"><i class="fas fa-arrow-left !mr-2"></i>Regresar</x-button>
                        <x-button type="submit" id="siguiente3">Guardar<i class="fas fa-save !mr-0 !ml-2"></i></x-button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="estudiante_encrypt" value="{{ encrypt($estudiantes->id) }}">
            <input type="hidden" name="periodo_encrypt" value="{{ encrypt($periodo->id) }}">
        </form>
    </div>
</div>
<x-error-and-correct-dialog />
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
</x-dashboard>
