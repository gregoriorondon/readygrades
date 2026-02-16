<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Descargar Y Enviar Planilla Preinscripcion</title>
        <x-import />
        <link rel="stylesheet" href="/css/menu.css">
        @vite(['public/css/style.css'])
    </head>
<body class="cuerpo">
    <x-menuuptt />
    <div class="mx-3 my-7 flex justify-center">
        <div class="!max-w-[500px]">
            <div class="text-center mb-8">
                <i class="far fa-check text-7xl mx-auto text-ready"></i>
                <h1 class="text-ready tracking-normal font-inter font-bold text-4xl uppercase">¡Ya estás registrado!</h1>
            </div>
            <p>Vimos que ya habías completado tu preinscripción. No te preocupes, aquí tienes tu comprobante:</p>
            <ul class="list-inside">
                <li class="list-decimal list-inside pl-7">El archivo PDF se descargará automáticamente ahora mismo.</li>
                <li class="list-decimal list-inside pl-7 mt-3">También te lo acabamos de reenviar a tu correo <i>({{ $r->email }}).</i></li>
            </ul>
            <div class="text-center my-7">
                <p class="mt-3"><strong><i>¡No lo olvides! Debes imprimirlo y entregarlo con el resto de la documentación para completar tu trámite.</i></strong></p>
            </div>
            <div class="flex justify-between mb-8">
                <x-button-a class="hover:text-white" link="student">Regresar</x-button-a>
                <x-button-a class="hover:text-white" link="download-planilla-pregrado/{{ $cedula }}/download">Descargar</x-button-a>
            </div>
        </div>
    </div>
<script>
window.onload = function() {
    var iframe = document.createElement("iframe");
    iframe.style.display = "none";
    iframe.src = "/download-planilla-pregrado/{{ $cedula }}/download";
    document.body.appendChild(iframe);
};
</script>
<x-footer-original />
</body>
</html>
