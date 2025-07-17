<x-dashboard>
    <x-slot:titulo>Configuración de la cuenta</x-slot:titulo>
    <x-title-section-admin>Configurar su cuenta</x-title-section-admin>
    <x-form-config :datos="$datos" :sesiones="$sesiones" />
        <x-error-and-correct-dialog />
</x-dashboard>
