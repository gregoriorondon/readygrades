<x-dashboard>
    <x-slot:titulo>Detalles de {{ $docentes['primer-name'] }}</x-slot:titulo>
    <x-title-section-admin>Información Del Docente {{ implode(' ', [$docentes['primer-name'], $docentes['primer-apellido']]) }}</x-title-section-admin>
<div class="">
  <div class="mt-7 border border-gray-300 rounded-md">
    <dl class="divide-y divide-gray-300 ">
      <x-details-div>
        <x-details-dt>Nombre Completo Del Docente</x-details-dt>
        <x-details-dd>{{ implode(' ', [$docentes['primer-name'], $docentes['segundo-name']]) }}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Apellido Completo Del Docente</x-details-dt>
        <x-details-dd>{{ implode(' ', [$docentes['primer-apellido'], $docentes['segundo-apellido']]) }}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Correo Electrónico</x-details-dt>
        <x-details-dd>{{ $docentes['email'] }} <a target="_blank" href="mailto:{{$docentes['email']}}" title="Abrir gestor de correo para enviarle un correo electrónico"><i class="fa-solid fa-envelope-open-text text-lg ml-3"></i></a></x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Cédula</x-details-dt>
        <x-details-dd>
            @if($docentes->nacionalidad === 'VE')
                V -
            @else
                E -
            @endif{{ $docentes['cedula'] }}</x-details-dd>
      </x-details-div>
       <x-details-div>
        <x-details-dt>Genero</x-details-dt>
        <x-details-dd>{{ $docentes['genero']}}</x-details-dd>
      </x-details-div>
      <x-details-div>
          <x-details-dt>Núcleo De Trabajo</x-details-dt>
          <x-details-dd>{{ $docentes->nucleos->nucleo }}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Cargo Actual Que Ejerce</x-details-dt>
        <x-details-dd>{{ $docentes->cargos->cargo }}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Titulo Obtenido</x-details-dt>
        <x-details-dd>{{ strtoupper($docentes->estudios->estudio . ' ' . $docentes->estudios->abrev) }}</x-details-dd>
      </x-details-div>
    </dl>
  </div>
</div>

</x-dashboard>
