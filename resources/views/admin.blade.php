<x-dashboard>
    <x-slot:titulo>Dashboard</x-slot:titulo>
    {{-- <x-slot name="header"> --}}
        <h2 class="font-bold text-xl text-[#4272d8] leading-tight">Administración</h2>
    {{-- </x-slot> --}}
    <div class="py-12">
        <div class="mx-auto">
            <div class="overflow-hidden shadow-2xl sm:rounded-lg">
                <x-list-adminis />
            </div>
        </div>
    </div>
</x-dashboard>
