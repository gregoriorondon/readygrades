<x-dashboard>
    <x-slot:titulo>{{ ucwords('editar datos de ') . $estudiantes->primer_name }}</x-slot:titulo>
    <x-title-section-admin>{{ ucwords('editar datos de ') . $estudiantes->primer_name . ' ' . $estudiantes->primer_apellido }}</x-title-section-admin>
    <div>
        <div>
            <div>
                <form method="POST" action="/guardar-edit-estudiante">
                    @csrf
                    <div class="space-y-12 p-[21px]">
                        <div class="border-gray-900/10 pb-12">
                            <p class="mt-7 text-xl font-inter text-gray-400">
                                {{ mb_convert_case('cambie únicamente los datos que desea corregir', MB_CASE_TITLE, 'UTF-8') }}
                            </p>

                            <div class="border-gray-900/10 pb-12">
                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="sm:col-span-3">
                                        <div class="mt-2">
                                            <x-label>Nombre Completo</x-label>
                                            <x-input-form type="text" name="primer_name" id="first-name"
                                                placeholder="Primer Nombre (Obligatorio)"
                                                value="{{ $estudiantes->primer_name }}" required autocomplete="off" />
                                            <x-input-form type="text" name="segundo_name" id="first-name"
                                                placeholder="Segundo Nombre" value="{{ $estudiantes->segundo_name }}"
                                                autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-3">
                                        <div class="mt-2">
                                            <x-label>Apellido Completo</x-label>
                                            <x-input-form type="text" name="primer_apellido" id="last-name"
                                                placeholder="Primer Apellido (Obligatorio)"
                                                value="{{ $estudiantes->primer_apellido }}" required
                                                autocomplete="off" />
                                            <x-input-form type="text" name="segundo_apellido" id="last-name"
                                                placeholder="Segundo Apellido"
                                                value="{{ $estudiantes->segundo_apellido }}" autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-1 mt-2 sm:col-start-1">
                                        <x-label class="after:content-['*'] after:text-red-400">Genero / Sexo</x-label>
                                        <div class="flex items-center">
                                            <x-select-form class="sm:max-w-full" name="genero">
                                                <option value="{{ $estudiantes->genero }}">
                                                    {{ ucwords($estudiantes->genero . ' (Registrado)') }}</option>
                                                <option value="masculino">Masculino</option>
                                                <option value="femenino">Femenino</option>
                                            </x-select-form>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <div class="mt-2">
                                            <x-label
                                                class="after:content-['*'] after:text-red-400">Nacionalidad</x-label>
                                            <x-select-form class="sm:max-w-full" id="nacionalidad" name="nacionalidad">
                                                @if ($estudiantes->nacionalidad === 'VE')
                                                    <option value="VE">Venezolano(a) (Registrado)</option>
                                                @else
                                                    <option value="EX">Extranjero(a) (Registrado)</option>
                                                @endif
                                                <option value="VE">Venezolano(a)</option>
                                                <option value="EX">Extranjero(a)</option>
                                            </x-select-form>
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <div class="mt-2">
                                            <x-label class="after:content-['*'] after:text-red-400">Cédula de
                                                Identidad</x-label>
                                            <x-input-form class="sm:max-w-full" type="number" name="cedula"
                                                id="cedula" placeholder="Número de Cedula del Estudiante"
                                                value="{{ $estudiantes->cedula }}" required autocomplete="off" />
                                            <x-input-error name="cedula" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <div class="mt-2">
                                            <x-label class="after:content-['*'] after:text-red-400">Fecha de
                                                Nacimiento</x-label>
                                            <x-input-form class="sm:max-w-full" type="date" name="fecha_nacimiento"
                                                id="fecha-nacimiento" value="{{ $estudiantes->fecha_nacimiento }}"
                                                required />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2 sm:col-start-1">
                                        <div class="mt-2">
                                            <x-label>Correo / Email</x-label>
                                            <x-input-form type="email" name="email" id="email"
                                                placeholder="Dirección de Correo Electrónico del Estudiante"
                                                value="{{ $estudiantes->email }}" autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <div class="mt-2">
                                            <x-label>Teléfono</x-label>
                                            <x-input-form type="tel" name="telefono" id="telefono"
                                                placeholder="Teléfono del Estudiante"
                                                value="{{ $estudiantes->telefono }}" autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <div class="mt-2">
                                            <x-label class="after:content-['*'] after:text-red-400">Dirección</x-label>
                                            <x-input-form type="text" name="direccion" id="direccion"
                                                placeholder="Dirección del Estudiante"
                                                value="{{ $estudiantes->direccion }}" required autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <div class="mt-2">
                                            <x-label class="after:content-['*'] after:text-red-400">Ciudad</x-label>
                                            <x-input-form type="text" name="city" id="city"
                                                placeholder="Ciudad o Pueblo del Estudiante"
                                                value="{{ $estudiantes->city }}" required autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="gap-x-6 gap-y-8 sm:grid-cols-6 divcarreratramonucleo">
                                        <div class="carreratramonucleo">
                                            <div class="mt-2">
                                                <x-label class="after:content-['*'] after:text-red-400">Carrera a
                                                    Estudiar</x-label>
                                                <x-select-form class="sm:max-w-full" name="carrera_id"
                                                    id="carreras_id">
                                                    <option value="{{ $estudiantes->carreras->id }}">
                                                        {{ $estudiantes->carreras->carrera }} (Registrado)</option>
                                                    @foreach ($courses as $carrera)
                                                        <option value="{{ $carrera->id }}">{{ $carrera->carrera }}
                                                        </option>
                                                    @endforeach
                                                </x-select-form>
                                            </div>
                                        </div>
                                        <div class="carreratramonucleo">
                                            <div class="mt-2">
                                                <x-label class="after:content-['*'] after:text-red-400">Tramo y
                                                    Trayecto</x-label>
                                                <x-select-form class="sm:max-w-full" name="tramo_trayecto_id">
                                                    <option value="{{ $estudiantes->tramos->id }}">
                                                        {{ $estudiantes->tramos->tramos }} (Registrado)</option>
                                                    @foreach ($trayectos as $trayecto)
                                                        <optgroup label="{{ $trayecto->trayectos }}">
                                                            @foreach ($trayecto->tramos as $tramos)
                                                                <option value="{{ $tramos->pivot->id }}">
                                                                    {{ $tramos->tramos }}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </x-select-form>
                                            </div>
                                        </div>
                                        <div class="carreratramonucleo">
                                            <div class="mt-2">
                                                <x-label
                                                    class="after:content-['*'] after:text-red-400">Núcleos</x-label>
                                                <x-select-form class="sm:max-w-full" name="nucleo_id">
                                                    <option value="{{ $estudiantes->nucleos->id }}">
                                                        {{ $estudiantes->nucleos->nucleo }} (Registrado)</option>
                                                    @foreach ($nucleos as $nucleo)
                                                        <option value="{{ $nucleo->id }}">{{ $nucleo->nucleo }}
                                                        </option>
                                                    @endforeach
                                                </x-select-form>
                                            </div>
                                        </div>
                                        <div class="carreratramonucleo">
                                            <div class="mt-2">
                                                <x-label
                                                    class="after:content-['*'] after:text-red-400">Sección</x-label>
                                                <x-select-form class="sm:max-w-full" name="seccion_id">
                                                    <option value="{{ $estudiantes->secciones->id }}">
                                                        {{ $estudiantes->secciones->seccion }} (Registrado)</option>
                                                    @foreach ($secciones as $seccion)
                                                        <option value="{{ $seccion->id }}">{{ $seccion->seccion }}
                                                        </option>
                                                    @endforeach
                                                </x-select-form>
                                            </div>
                                        </div>
                                        <div class="carreratramonucleo">
                                            <div class="mt-2">
                                                <x-label class="after:content-['*'] after:text-red-400">Agregar
                                                    Código</x-label>
                                                <x-input-form name="codigo" autocomplete="off"
                                                    placeholder="Agregar código al estudiante"
                                                    value="{{ $estudiantes->codigo }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-between gap-x-6">
                                <x-button class="bg-[#f00] hover:bg-[#b00]" type="button"
                                    onclick="history.back()">Cancelar</x-button>
                                <x-button type="submit">Guardar Cambios</x-button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="estudiante_id" value="{{ $estudiantes->id }}">
                    <input type="hidden" name="periodo_id" value="{{ $estudiantes->periodo_id }}">
                </form>
            </div>
        </div>
    </div>
    <x-error-and-correct-dialog />
</x-dashboard>
