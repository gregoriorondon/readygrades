@if (!$errors->all())
    <x-dialog-modal-correct class="transition-all">
        <x-slot:botones>
            Cerrar
        </x-slot:botones>
    </x-dialog-modal-correct>
@else
    <x-dialog-modal-errors class="transition-all">
        <x-slot:botones>
            Cerrar
        </x-slot:botones>
    </x-dialog-modal-errors>
@endif
