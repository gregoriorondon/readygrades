<dialog {{ $attributes->merge(['id'=>'modal']) }}>
    <div class="text-2xl text-center font-bold font-inter text-[#f00]">
        <i class="fa-regular fa-triangle-exclamation mr-0 text-[#f00] text-7xl"></i>
            <br class="mt-4">
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach
        {{-- {{ $title }} --}}
        <br class="mt-4">
    </div>
    <div class="font-inter flex justify-center mt-3">
        <x-button id="cerrarmodal" type="button" class="bg-[#f00] hover:bg-[#b00] focus:ring-transparent focus-visible:ring-transparent focus:outline-none">
            {{ $botones }}
        </x-button>
    </div>
</dialog>
@if($errors->any())
    <script>
        let dialogo = document.querySelector('#modal');
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
