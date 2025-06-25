<dialog {{ $attributes->merge(['id'=>'modalcorrect']) }}>
    <div class="text-2xl text-center font-bold font-inter text-green-600">
        <i class="fa-solid fa-check mr-0 text-green-600 text-7xl"></i>
            <br class="mt-4">
            {{ session('alert') }}<br>
        <br class="mt-4">
    </div>
    <div class="font-inter flex justify-center mt-3">
        <x-button id="cerrarmodal" type="button" class="bg-green-600 hover:bg-green-800 focus:ring-transparent focus-visible:ring-transparent focus:outline-none">
            {{ $botones }}
        </x-button>
    </div>
</dialog>
@if(session('alert'))
    <script>
        let dialogo = document.querySelector('#modalcorrect');
        let botonAbrir = document.querySelector('#abrirmodal');
        let botonCerrar = document.querySelectorAll('#cerrarmodal');
            dialogo.showModal();
            botonCerrar.forEach(element => {
                element.addEventListener('click', ()=>{
                    dialogo.close();
                })
            });
    </script>
@endif
