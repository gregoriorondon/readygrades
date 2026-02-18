<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>
    <x-import />
    <link rel="stylesheet" href="/css/menu.css">
    @vite(['public/css/style.css'])
    <script>
        console.warn("Cuidado Usuario");
        console.warn("Si eres un usuario normal POR FAVOR NO USES ESTA CONSOLA")
        console.log("%c%s","color:red;background-color:yellow;font-size:25px;border-radius:10px;padding:0px 7px 0px 7px;","Cuidado!!!");
        console.log("%c%s","font-size: 18px;","No utilices esta consola, no escribas ni pegues ning\u00fan c\u00f3digo o script.");
    </script>
<body class="cuerpo">
    <x-menuuptt />
        <div class="mt-7 mx-auto max-w-[90%] lg:max-w-[900px]">
            <div class="flex justify-center mb-7">
                <img src="/logouptt.png" style="width: 100px">
            </div>
            <h2 style="font-size: 40px; font-weight: 900; color: #4272D8;"
                class="font-inter uppercase leading-none tracking-normal text-center">¡Bienvenid@ a la UPTTMBI!</h2>
            <p>Te damos la más cordial bienvenida y celebramos tu decisión de ser parte de esta institución, donde la excelencia es nuestro compromiso. Estás a un paso de comenzar la aventura más transformadora de tu vida.
            <br class="mt-3">
            Para formalizar tu inscripción, por favor completa tus datos en el siguiente formulario. Al finalizar, <b>no olvides descargar e imprimir tus documentos de inscripción, ya que son tu pase de ingreso oficial.</b></p>
            <p style="font-style: italic;" class="text-center">¡El futuro que imaginas está por comenzar, y estamos aquí para acompañarte en cada logro!</p>
            <br class="mt-7">
            <h3 style="font-size: 30px; font-weight: 800; color: #4272D8;"
                class="font-inter uppercase leading-none tracking-normal text-center">Formulario De Registro</h3>
            @if ($errors->any())
                <div class="my-4">
                    @foreach ($errors->all() as $error)
                        <p class="text-md text-[#E30000] bg-[#FFFC9C] p-2 font-bold rounded-md font-inter mb-2 border-l-4 border-[#E30000]">
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            @if(session('error'))
                <div class="text-center text-md text-[#E30000] bg-[#FFFC9C] p-1 font-bold rounded-md font-inter mt-2">
                    {{ session('error') }}
                </div>
            @endif
            <br>
            <form action="/inscribirse" method="post">
                @csrf
                <div class="space-b-12">
                    <div class="border-gray-900/10 pb-12">
                        <div class="border-gray-900/10 pb-12">
                            {{-- Datos Personales --}}
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-3 " id="datosAcademicos">
                                <h4 class="md:col-span-3">Selección De Núcleo y Carrera</h4>
                                <p class="md:col-span-3">{{ ucwords('si no aparece el núcleo académico más cercano/seleccionado, por favor espere a que abran sus inscripciones.') }}</p>
                                <div class="md:col-span-3">
                                    @livewire('formulario-inscripcion')
                                </div>
                                <div class="md:col-span-3 flex justify-between mt-12">
                                    <x-button type="button" id="atras1" disabled>Regresar</x-button>
                                    <x-button type="button" id="siguiente1">Siguiente</x-button>
                                </div>
                            </div>
                            {{-- Datos Personales --}}
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-3 hidden" id="datosPersonales">
                                <h4>Datos Personales</h4>
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
                                            placeholder="Ciudad/Pueblo Donde Nacistes" :value="old('nacimiento_city')" required
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
                                <div class="md:col-span-2">
                                    <div class="mt-2">
                                        <x-label for="direccion" class="after:content-['*'] after:text-red-400">Dirección</x-label>
                                        <x-input-form type="text" maxlength="80" name="direccion" id="direccion"
                                            placeholder="Dirección Donde Vives" :value="old('direccion')" required autocomplete="off" />
                                        <x-input-error name="direccion" />
                                    </div>
                                </div>
                                <div class="md:col-span-1">
                                    <div class="mt-2">
                                        <x-label for="city" class="after:content-['*'] after:text-red-400">Ciudad</x-label>
                                        <x-input-form type="text" maxlength="43" name="city" id="city"
                                            placeholder="Ciudad/Pueblo Donde Vives" :value="old('city')" required
                                            autocomplete="off" />
                                    </div>
                                </div>
                                <div class="md:col-span-1">
                                    <div class="mt-2">
                                        <x-label for="consejo" class="after:content-['*'] after:text-red-400">Consejo Comunal</x-label>
                                        <x-input-form type="text" maxlength="80" name="consejo" id="concejo"
                                            placeholder="Nombre Del Consejo Comunal" :value="old('consejo')" required
                                            autocomplete="off" />
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <div class="mt-2">
                                        <x-label for="comuna" class="after:content-['*'] after:text-red-400">Nombre De Su Comuna</x-label>
                                        <x-input-form type="text" maxlength="80" name="comuna" id="comuna"
                                            placeholder="Nombre De La Comuna" :value="old('comuna')" required
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
                                    <x-button type="button" id="atras2">Regresar</x-button>
                                    <x-button type="button" id="siguiente2">Siguiente</x-button>
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
                                            placeholder="Especialidad Que Te Graduaste, Ej. Ciencias" :value="old('mencion')" required
                                            autocomplete="off" />
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <div class="mt-2">
                                        <x-label for="institucion" class="after:content-['*'] after:text-red-400">Institución</x-label>
                                        <x-input-form type="text" maxlength="80" name="institucion" id="institucion"
                                            placeholder="Institución Donde Te Graduaste" :value="old('institucion')"
                                            required
                                            autocomplete="off" />
                                    </div>
                                </div>
                                <div class="md:col-span-1">
                                    <div class="mt-2">
                                        <x-label for="cityinstitucion" class="after:content-['*'] after:text-red-400">Ciudad</x-label>
                                        <x-input-form type="text" maxlength="43" name="cityinstitucion" id="cityinstitucion"
                                            placeholder="Ciudad De La Institución" :value="old('cityinstitucion')"
                                            required
                                            autocomplete="off" />
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <div class="mt-2">
                                        <x-label for="fecha_grado" class="after:content-['*'] after:text-red-400">Fecha Del Grado</x-label>
                                        <x-input-form class="sm:max-w-full" type="date" name="fecha_grado"
                                            id="fecha_grado" :value="old('fecha_grado')" required />
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
                                <div class="md:col-span-3">
                                    <p><b>Recuerde Llevar Los Siguientes Documentos Para Completar El Registro:</b></p>
                                    <ul>
                                        <li class="list-disc list-inside">Documento adjunto en el correo que te va a llegar (impreso).</li>
                                        <li class="list-disc list-inside">Fondo Negro del Título de Bachiller / TSU</li>
                                        <li class="list-disc list-inside">Fotocopia de Partida de Nacimiento</li>
                                        <li class="list-disc list-inside">Planilla Asignación / Comprobante de OPSU</li>
                                        <li class="list-disc list-inside">Fotocopia de C.I  (Se verifica con la original)</li>
                                        <li class="list-disc list-inside">Una (1) Fotografía Tipo Carnet</li>
                                        <li class="list-disc list-inside">Fotocopias de Notas certificadas (Se verifica SNI)</li>
                                    </ul>
                                </div>
                                <div class="md:col-span-3 flex justify-between mt-12">
                                    <x-button type="button" id="atras3">Regresar</x-button>
                                    <x-button type="submit" id="siguiente3">Finalizar</x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @vite(['resources/js/back-cedula-public-studens.js'])
<x-footer-original />
<script>
    const nucleo = document.getElementById('datosAcademicos');
    const personal = document.getElementById('datosPersonales');
    const procedencia = document.getElementById('datosProcedencia');
    const seccion1 = document.getElementById('siguiente1');
    const seccion2 = document.getElementById('siguiente2');
    const seccion3 = document.getElementById('siguiente3');
    const atras2 = document.getElementById('atras2');
    const atras3 = document.getElementById('atras3');

    seccion1.addEventListener('click', () => {
        nucleo.classList.add('hidden');
        personal.classList.remove('hidden');
    });
    atras2.addEventListener('click', () => {
        nucleo.classList.remove('hidden');
        personal.classList.add('hidden');
    });
    seccion2.addEventListener('click', () => {
        personal.classList.add('hidden');
        procedencia.classList.remove('hidden');
    });
    atras3.addEventListener('click', () => {
        personal.classList.remove('hidden');
        procedencia.classList.add('hidden');
    });
</script>
</body>
</html>
