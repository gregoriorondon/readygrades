<x-dashboard>
    <x-slot:titulo>Detalles de {{ $estudiantes['primer-name'] }}</x-slot:titulo>
    <x-title-section-admin>Información del Estudiante {{ implode(' ', [$estudiantes['primer-name'], $estudiantes['primer-apellido']]) }}</x-title-section-admin>
<div>
  <div class="mt-6 border-t border-gray-100">
    <dl class="divide-y divide-gray-100">
      <x-details-div>
        <x-details-dt>Nombre Completo del Estudiante</x-details-dt>
        <x-details-dd>{{ implode(' ', [$estudiantes['primer-name'], $estudiantes['segundo-name']]) }}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Apellido Completo del Estudiante</x-details-dt>
        <x-details-dd>{{ implode(' ', [$estudiantes['primer-apellido'], $estudiantes['segundo-apellido']]) }}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Correo Electrónico</x-details-dt>
        <x-details-dd>{{ $estudiantes['email']}}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Cédula</x-details-dt>
        <x-details-dd>{{ $estudiantes['cedula'] }}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Teléfono</x-details-dt>
        <x-details-dd>{{ $estudiantes['telefono']}}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Fecha de Nacimiento</x-details-dt>
        <x-details-dd>{{ $estudiantes['fecha-nacimiento']}}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Genero</x-details-dt>
        <x-details-dd>{{ $estudiantes['genero']}}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Ciudad - Pueblo</x-details-dt>
        <x-details-dd>{{ $estudiantes['city']}}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Carrera</x-details-dt>
        <x-details-dd>{{ $estudiantes['carrera']}}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Trayecto y Tramo</x-details-dt>
        <x-details-dd>{{ $estudiantes['trayecto']}}</x-details-dd>
      </x-details-div>
    </dl>
  </div>
</div>

</x-dashboard>
