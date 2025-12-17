<div wire:offline>
    <div class="flex justify-center absolute left-1/2 -translate-x-1/2 z-[5]">
        <p class="select-none text-center p-4 text-white bg-red-700 rounded-lg"><i class="fal fa-exclamation-triangle"></i>{{ ucwords('no tienes conexión a internet') }}</p>
    </div>
    <div class="fixed inset-0 z-[4] bg-black opacity-50 hidden" wire:offline.class.remove="hidden"></div>
</div>
