    <title>Estudiantes</title>
    <x-import />
    <script>
        console.warn("Cuidado Usuario");
        console.warn("Si eres un usuario normal POR FAVOR NO USES ESTA CONSOLA")
        console.log("%c%s","color:red;background-color:yellow;font-size:25px;border-radius:10px;padding:0px 7px 0px 7px;","Cuidado!!!");
        console.log("%c%s","font-size: 18px;","No utilices esta consola, no escribas ni pegues ning\u00fan c\u00f3digo o script.");
    </script>
<body class="cuerpo">
    <x-nav />
    <div>
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>
            <h1 style="font-size: 40px; font-weight: 700; color: #4272D8;" class="font-staat">Ver sus Datos Académicos</h1>
            <p class="font-inter mb-7">Introduzca una cédula válida, compuesta únicamente por números, sin incluir caracteres especiales.</p>
            <form method="POST" action="/detalles-estudiante">
                @csrf
                <div>
                    <x-input type="number" name="cedula" placeholder="Ingrese su Cédula" />
                    <x-input-error name="cedula" />
                </div>
                <div class="flex items-center justify-end mt-4">
                <x-button-login class="mt-7">
                    Ver sus Datos Académicos
                </x-button-login>
            </div>
            <div class="warni">
                <span class="war1 font-inter">Tenga en cuenta que si intenta copiar o tomar alguna foto de las notas que quiere visualizar</span>
                <span class="war2 font-inter">NO TIENEN NINGÚN VALOR ACADÉMICO LEGAL</span>
            </div>
            </form>
        </x-authentication-card>
    </div>
<x-minifoot />
<x-footer />
</body>
