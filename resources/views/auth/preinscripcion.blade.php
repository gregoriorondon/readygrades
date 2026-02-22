<x-dashboard>
    <x-slot:titulo>Buscar Aspirante</x-slot:titulo>
    <x-title-section-admin>Buscar Aspirantes Para Registrar</x-title-section-admin>

    <div class="max-w-[700px] mx-auto my-[15dvh] flex flex-col items-center">
        <form action="/aspirante/search" method="get" class="w-full">
            <h2 class="text-center text-3xl text-ready font-inter font-bold mb-2">Ingresa La Cédula Para Buscar</h2>
            <div class="flex justify-center">
                <x-input class="bg-transparent !m-0 rounded-r-none border-r-0" type="number" name="cedula" id="cedula" autofocus placeholder="Ingrese La Cédula" autocomplete="off" required :value="old('cedula')" />
                <x-button class="rounded-l-none" type="submit" icon="fas fa-search">Buscar</x-button>
            </div>
            <x-validation-errors name="cedula" class="mt-4" />
        </form>
        <x-button type="button" icon="fas fa-qrcode" id="abrirmodal" class="mt-7">Escanear QR</x-button>
    </div>

<dialog class="!mx-auto" id="modal">
    <div class="flex flex-col justify-center">
        <div class="mb-6 flex flex-col justify-center items-center aspect-video bg-gray-300/50 text-gray-500 h-96 w-full max-w-md overflow-hidden rounded-lg" id="toggle-scan" type="button">
            <i class="fa-solid fa-qrcode !m-0 text-7xl"></i>
            <p>Escanear QR</p>
        </div>
        <div id="video-container" class="relative h-96 w-full max-w-md aspect-video bg-black rounded-lg overflow-hidden mb-6 hidden">
            <video id="test-video" class="w-full h-full object-cover"></video>
        </div>
        <div class="my-7 bg-[#f00] hover:bg-[#b00] text-center text-white rounded-md px-4 py-2 cursor-pointer" id="cerrarmodal">
            Cerrar Escaner
        </div>
        <audio src="/sound/clickNotify.mp3" id="qr-audio" hidden></audio>
    </div>
</dialog>
    <script type="module">
        import QrScanner from './js/qr-scanner.min.js';

        const videoElem = document.getElementById('test-video');
        const videoContainer = document.getElementById('video-container');
        const inputElem = document.getElementById('cedula');
        const btnToggle = document.getElementById('toggle-scan');
        const btnText = document.getElementById('btn-text');
        let dialogo = document.getElementById('modal');
        let botonAbrir = document.getElementById('abrirmodal');
        let botonCerrar = document.querySelectorAll('#cerrarmodal');
        const qrAudio = document.getElementById('qr-audio');

        botonAbrir.addEventListener('click', ()=>{
            dialogo.showModal();
        });

        let isScanning = false;

        const qrScanner = new QrScanner(
            videoElem,
            result => {
                qrAudio.play();
                inputElem.value = result.data;
                stopScanner();
            },
            {
                highlightScanRegion: true,
                highlightCodeOutline: true,
            }
        );

        function startScanner() {
            videoContainer.classList.remove('hidden');
            qrScanner.start().catch(err => {
                videoContainer.innerHTML = "<p class='text-white text-center mt-7 text-3xl'>No Se Detectó Ningúna Cámara</p>"
            });
            btnToggle.classList.add('hidden');
            isScanning = true;
        }

        function stopScanner() {
            qrScanner.stop();
            videoContainer.classList.add('hidden');
            btnToggle.classList.remove('hidden');
            dialogo.close();
            isScanning = false;
        }

        btnToggle.addEventListener('click', () => {
            startScanner();
        });

        botonCerrar.forEach(element => {
            element.addEventListener('click', () => {
                stopScanner();
            })
        });
    </script>
</x-dashboard>
