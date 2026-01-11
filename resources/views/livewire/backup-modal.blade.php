<div>
    <div class="min-[400px]:flex min-[400px]:justify-between">
        <x-button type="button" icon="fa-solid fa-plus-large" class="max-[399px]:mb-4" wire:click="toggleModalA">Nuevo Correo</x-button>
        <x-button type="button" icon="far fa-calendar-alt" wire:click="toggleModalB">Fecha De respaldo</x-button>
    </div>

    @if($showModalA)
        <div class="modal-overlay transition-all">
            <div class="modal-content w-[400px]" id="modal">
                <i wire:click="toggleModalA" id="cerrarmodal" class="fa-solid fa-xmark-large m-0 text-md bg-[#f00] hover:bg-[#b00] text-[#fff] p-1 rounded-sm cursor-pointer float-right"></i>
                <div class="text-xl text-center font-bold font-inter mb-4 select-none">
                    Registro Del Nuevo Correo
                </div>
                <form action="/backupadd" method="POST" id="emailform">
                    @csrf
                    <x-span class="mt-4 text-sm font-inter select-none">Inserte El Nuevo Correo Electrónico</x-span>
                    <br>
                    <x-input class="bg-transparent mt-2" id="autocomplete" type="text" name="email" placeholder="Ingrese El Correo Electrónico" required autocomplete="off" />
                    <div class="font-inter flex justify-between mt-3">
                        <x-button wire:click="toggleModalA" id="cerrarmodal" type="button" class="bg-[#f00] hover:bg-[#b00]">Cancelar</x-button>
                        <x-button form="emailform" type="submit" id=''>Guardar</x-button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    @if($showModalB)
        <div class="modal-overlay">
            <div class="modal-content" id="modal">
                <i wire:click="toggleModalB" id="cerrarmodal" class="fa-solid fa-xmark-large m-0 text-md bg-[#f00] hover:bg-[#b00] text-[#fff] p-1 rounded-sm cursor-pointer float-right"></i>
                <div class="text-xl text-center font-bold font-inter mb-4 select-none">
                    {{ ucwords('seleccione el día para hacer la copia de seguridad') }}
                </div>
                <form action="/backupday" method="POST" id="dayform">
                    @csrf
                        @if ($days === null)
                            <x-select-form name="day">
                                <option value="lunes">Lunes</option>
                                <option value="martes">Martes</option>
                                <option value="miercoles">Miércoles</option>
                                <option value="jueves">Jueves</option>
                                <option value="viernes">Viernes</option>
                                <option value="sabado">Sábado</option>
                                <option value="domingo">Dominigo</option>
                            </x-select-form>
                            <input type="hidden" name="predays" value="{{ encrypt('none') }}">
                        @else
                            <x-select-form name="day">
                                <option value="{{ $days->day }}">{{ ucwords('actualmente ' . $days->day) }}</option>
                                <option value="lunes">Lunes</option>
                                <option value="martes">Martes</option>
                                <option value="miercoles">Miércoles</option>
                                <option value="jueves">Jueves</option>
                                <option value="viernes">Viernes</option>
                                <option value="sabado">Sábado</option>
                                <option value="domingo">Dominigo</option>
                            </x-select-form>
                            <input type="hidden" name="predays" value="{{ encrypt($days->id) }}">
                        @endif
                    <br>
                    <div class="font-inter flex justify-between mt-3">
                        <x-button wire:click="toggleModalB" id="cerrarmodal" type="button" class="bg-[#f00] hover:bg-[#b00]">Cancelar</x-button>
                        <x-button form="dayform" type="submit" id=''>Guardar</x-button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <style>
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex; justify-content: center; align-items: center;
            z-index: 2;
        }
        #modal{
            margin-left: 17px;
            margin-right: 17px;
        }
    </style>
</div>
