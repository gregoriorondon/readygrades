<x-dashboard>
    <x-slot:titulo>Dashboard</x-slot:titulo>
    {{-- <x-slot name="header"> --}}
        {{-- <h2 class="font-bold text-xl text-[#4272d8] leading-tight">Administración</h2> --}}
    {{-- </x-slot> --}}
    <div class="py-4">
        <div class="mx-auto">
            <div class="overflow-hidden border border-black/50 sm:rounded-lg">
                <x-list-adminis />
            </div>
        </div>
    </div>
</x-dashboard>
