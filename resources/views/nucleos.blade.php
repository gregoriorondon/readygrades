<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Núcleos</title>

    <link rel="stylesheet" href="{{ asset('node_modules/nprogress/nprogress.css') }}">
    @vite(['resources/css/app.scss'])
    <x-import />
    <style>
        .banner {
            background-image: url('/img/banner.webp');
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100dvh;
            user-select: none;
        }

        .slide-left-1 {
            font-size: 350%;
            -webkit-animation: slide-left 1s cubic-bezier(0.075, 0.820, 0.165, 1.000) 2s both;
            animation: slide-left 1s cubic-bezier(0.075, 0.820, 0.165, 1.000) 2s both;
        }

        .slide-left-2 {
            font-size: 350%;
            -webkit-animation: slide-left 1s cubic-bezier(0.075, 0.820, 0.165, 1.000) 2.5s both;
            animation: slide-left 1s cubic-bezier(0.075, 0.820, 0.165, 1.000) 2.5s both;
        }

        .slide-left-3 {
            font-size: 250%;
            -webkit-animation: slide-left 1s cubic-bezier(0.075, 0.820, 0.165, 1.000) 3s both;
            animation: slide-left 1s cubic-bezier(0.075, 0.820, 0.165, 1.000) 3s both;
        }

        @-webkit-keyframes slide-left {
            0% {
                -webkit-transform: translateX(100px);
                transform: translateX(100px);
                opacity: 0%;
            }

            100% {
                -webkit-transform: translateX(0px);
                transform: translateX(0px);
                opacity: 100%;
            }
        }

        @keyframes slide-left {
            0% {
                -webkit-transform: translateX(100px);
                transform: translateX(100px);
                opacity: 0%;
            }

            100% {
                -webkit-transform: translateX(0px);
                transform: translateX(0px);
                opacity: 100%;
            }
        }
    </style>
</head>
<body>
    <x-menuuptt />

    <div class="banner">
        <div>
            <h2 class="slide-left-1 text-white text-center">UNIVERSIDAD POLITÉCNICA TERRITORIAL</h2>
            <h2 class="slide-left-2 text-white text-center">DEL ESTADO TRUJILLO</h2>
            <h3 class="slide-left-3 text-white text-center">"MARIO BRICEÑO IRAGORRY"</h1>
                <div class="text-center mt-5">
                    <x-button class="!text-xl" icon="fa fa-download">Reseña Histórica</x-button>
                    <x-button class="!text-xl" icon="fa fa-download">Epónimo</x-button>
                    <x-button class="!text-xl" icon="fa fa-download">Logotipo</x-button>
                </div>
        </div>
    </div>
    <h2 class="text-center my-24">Núcleos Territoriales</h2>
    <div class="mx-64">
        <div class="my-24 flex justify-center items-center">
            <div class="w-[40%] mr-32">
                <h3>Núcleo "Fabricio Ojeda" - Boconó</h3>
                <p>Fundado el 5 de marzo del año 1988.
                <br>
                <b>Ubicado en:</b>
                    <br>
                    <u>Sede Principal:</u>
                    Calle Colón con Av. Independencia (Antigo Hospital "Rafael Rangel")
                    <br>
                    <u>Teléfono:</u> 0272-652.31.11.
                    <br>
                    <u>Sede CUSAM:</u> Troncal 07 Sector El Saman, diagonal al Estadium.</p>
                <x-button-a icon="fa fa-eye">{{ ucwords('ver en google maps') }}</x-button-a>
            </div>
            <div class="w-96">
                <img class="rounded-md" src="/img/tabs-image-01.webp" alt="">
            </div>
        </div>
        <div class="my-24 flex justify-center items-center">
            <div class="w-96">
                <img class="rounded-md" src="/img/tabs-image-02.webp" alt="">
            </div>
            <div class="w-[40%] ml-32">
                <h3>Núcleo "Francisco de Miranda" - El Dividive</h3>
                <p>Fundado el 16 de Noviembre de 1988.
                <br>
                <b>Ubicado en:</b>
                    <br>
                    Autopista Panamericana, El Dividive
                    <br>
                    <u>Teléfono:</u> 0272-666.01.14.</p>
                <x-button-a icon="fa fa-eye">{{ ucwords('ver en google maps') }}</x-button-a>
            </div>
        </div>
        <div class="my-24 flex justify-center items-center">
            <div class="w-[40%] mr-32">
                <h3>Núcleo "Dr. Pablo Viloria" - La Beatriz</h3>
                <p>Fundado el 18 de agosto de 1992.
                <br>
                <b>Ubicado en:</b>
                    <br>
                    Urb. La Beatriz Parte Alta al lado del Parque Botanico, Valera.
                    <br>
                    <u>Teléfono:</u> 0271-231.11.10.</p>
                <x-button-a icon="fa fa-eye">{{ ucwords('ver en google maps') }}</x-button-a>
            </div>
            <div class="w-96">
                <img class="rounded-md" src="/img/tabs-image-03.webp" alt="">
            </div>
        </div>
        <div class="my-24 flex justify-center items-center">
            <div class="w-96">
                <img class="rounded-md" src="/img/tabs-image-04.webp" alt="">
            </div>
            <div class="w-[40%] ml-32">
                <h3>Núcleo "Hugo Chávez" - San Luis
                    <br>
                    <u>Sede Rectoral</u></h3>
                <p>Fundado el 01 de Agosto de 1978.
                <br>
                <b>Ubicado en:</b>
                    <br>
                    Av. La Feria Sector San Luis. Frente al Gimnasio Ricardo Salas, Valera.
                    <br>
                    <u>Teléfono:</u> 0271-221.29.27.</p>
                <x-button-a icon="fa fa-eye">{{ ucwords('ver en google maps') }}</x-button-a>
            </div>
        </div>
        <div class="my-24 flex justify-center items-center">
            <div class="w-[40%] mr-32">
                <h3>Núcleo "Barbarita de la Torre" - Trujillo</h3>
                <p>Fundado el 18 de agosto de 1992.
                <br>
                <b>Ubicado en:</b>
                    <br>
                    Av. Cristobal Mendoza detrás del Mercado Municipal Sector Santa Rosa, Trujillo.
                    <br>
                    <u>Teléfono:</u> 0272-236.31.61.</p>
                <x-button-a icon="fa fa-eye">{{ ucwords('ver en google maps') }}</x-button-a>
            </div>
            <div class="w-96">
                <img class="rounded-md" src="/img/tabs-image-05.webp" alt="">
            </div>
        </div>
        <div class="my-24 flex justify-center items-center">
            <div class="w-96">
                <img class="rounded-md" src="/img/tabs-image-06.webp" alt="">
            </div>
            <div class="w-[40%] ml-32">
                <h3>Núcleo Carache</h3>
                <p>Fundada el 14 de Febrero de 2019.
                   Inicia como Extensión Académica y
                   Administrativa del Núcleo "Barbarita
                   de la Torre" - Trujillo.
                   Convertido a Núcleo en Diciembre del 2024
                <br>
                <b>Ubicado en:</b>
                    <br>
                    Calle Vargas entre Av.2 y Av.3, al lado Alcaldía del Municipio Carache.
                    <br>
                    <u>Teléfono:</u> 0272-999.16.05</p>
                <x-button-a icon="fa fa-eye">{{ ucwords('ver en google maps') }}</x-button-a>
            </div>
        </div>
        <div></div>
    </div>
    <x-footer-original />
</body>
</html>
