<x-dashboard>
    <x-slot:titulo>Copia de Seguridad</x-slot:titulo>
    <livewire:backup-modal :days="$days" />
    <x-title-section-admin class="select-none mt-7">{{ ucwords('correos para copias de seguridad') }}</x-title-section-admin>
        <div class="border-gray-200 border border-solid mt-2 rounded-lg">
            <div class="">
                <div class="flex flex-col overflow-x-auto">
                    <table class="select-none">
                        <thead class="border-b">
                            <tr>
                                <x-table-th-students class="min-w-full">
                                    Correo Electrónico
                                </x-table-th-students>
                                <x-table-th-students>
                                    Probar
                                </x-table-th-students>
                                <x-table-th-students>
                                    Editar
                                </x-table-th-students>
                                <x-table-th-students>
                                    Eliminar
                                </x-table-th-students>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse ($correos as $email)
                                <tr class="odd:bg-gray-100/20 event:bg-transparent">
                                    <x-table-td-students>
                                        {{ $email->email }}
                                    </x-table-td-students>
                                    <x-table-td-students class="text-center">
                                        <a href="{{ route('verifymail', $email->email) }}" class="bg-transparent hover:bg-ready hover:text-white p-3 rounded-lg cursor-pointer">
                                            <i class="fas fa-paper-plane m-0"></i>
                                        </a>
                                    </x-table-td-students>
                                    <x-table-td-students class="text-center">
                                        <a href="/backupedit/{{ $email->id }}" class="bg-transparent hover:bg-ready hover:text-white p-3 rounded-lg cursor-pointer">
                                            <i class="fas fa-edit m-0"></i>
                                        </a>
                                    </x-table-td-students>
                                    <x-table-td-students class="text-center">
                                        <a href="{{ route('deletemail', $email->email) }}" class="bg-transparent hover:bg-red-600 hover:text-white p-3 rounded-lg cursor-pointer">
                                            <i class="fas fa-trash m-0"></i>
                                        </a>
                                    </x-table-td-students>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="flex flex-col items-center justify-center p-10">
                                            <i class="fas fa-mail-bulk text-7xl text-gray-500"></i>
                                            <p class="mt-4 text-lg font-semibold text-gray-500">
                                                No hay correos electrónicos para mostrar
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<x-error-and-correct-dialog />
</x-dashboard>
