<dialog {{ $attributes->merge(['id'=>'modal']) }}>
    <i id="cerrarmodal" class="fa-solid fa-xmark-large m-0 text-md bg-[#f00] hover:bg-[#b00] text-[#fff] p-1 rounded-sm cursor-pointer float-right"></i>
    <div class="text-xl text-center font-bold font-inter text-gray-700">
        {{ $title }}
    </div>
    <div class="mt-4 text-sm text-gray-700 font-inter">
        {{ $content }}
    </div>
    <div class="font-inter flex justify-between mt-3">
        <x-button id="cerrarmodal" type="button" class="bg-[#f00] hover:bg-[#b00]">Cancelar</x-button>
        <x-button {{ $attributes->merge(['form'=>'', 'type'=>'submit'])->only('form') }}>{{ $botones }}</x-button>
    </div>
</dialog>
