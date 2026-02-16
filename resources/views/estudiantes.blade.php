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
    <div class="">
    <div>
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>
            <h1 style="font-size: 40px; font-weight: 700; color: #4272D8;"
                class="font-staat uppercase leading-none tracking-normal">Ver sus Datos Académicos
            </h1>
            <p class="font-inter mb-7">Introduzca una cédula válida, compuesta únicamente por números, sin incluir caracteres especiales.</p>
            <x-validation-errors class="my-4" />
            <form method="POST" action="/detalles-estudiante">
                @csrf
                <div>
                    <x-input class="bg-transparent" type="number" name="cedula" placeholder="Ingrese su Cédula" autocomplete="off" autofocus required value="{{ old('cedula') }}" />
                    <x-input-error name="cedula" />
                </div>
                <div>
                    @if ($nucleos->isEmpty())
                        <x-select-form disabled class="text-black/30">
                            <option value="none">{{ ucwords('aún no existe ningún núcleo académico') }}</option>
                        </x-select-form>
                    @else
                        <x-select-form name="nucleo_id">
                            <option value="none" selected disabled hidden>{{ ucwords('seleccione el núcleo académico') }}</option>
                            @foreach ($nucleos as $nucleo)
                                <option value="{{ $nucleo->id }}">{{ ucwords($nucleo->nucleo) }}</option>
                            @endforeach
                        </x-select-form>
                        <x-input-error name="nucleo_id" />
                    @endif
                </div>
                <div class="flex items-center justify-end mt-4">
                <x-button-login class="mt-7">
                    Ver sus Datos Académicos
                </x-button-login>
            </div>
            </form>
                <br>
            @if ($inscripcion !== null)
                <x-button-a link="inscribirse" class="mt-7 w-full font-inter !block text-center !text-white !text-sm">
                    Inscribirse Por Primera Vez
                </x-button-a>
            @endif
            <div class="warni">
                <span class="war1 font-inter">Tenga en cuenta que si intenta copiar o tomar alguna foto de las notas que quiere visualizar</span>
                <span class="war2 font-inter">NO TIENEN NINGÚN VALOR ACADÉMICO LEGAL</span>
            </div>
        </x-authentication-card>
    </div>
    </div>
<x-minifoot />
<x-footer-original />
</body>
</html>
