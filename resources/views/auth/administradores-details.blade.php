<x-dashboard>
    <x-slot:titulo>Detalles de {{ $administrador['primer-name'] }}</x-slot:titulo>
    <x-title-section-admin>Información Del Administrador {{ implode(' ', [$administrador['primer-name'], $administrador['primer-apellido']]) }}</x-title-section-admin>
<div class="">
  <div class="mt-7 border border-gray-300 rounded-md">
    <dl class="divide-y divide-gray-300 ">
      <x-details-div>
        <x-details-dt>Nombre Completo Del Administrador:</x-details-dt>
        <x-details-dd>{{ implode(' ', [$administrador['primer-name'], $administrador['segundo-name']]) }}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Apellido Completo Del Administrador:</x-details-dt>
        <x-details-dd>{{ implode(' ', [$administrador['primer-apellido'], $administrador['segundo-apellido']]) }}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Correo Electrónico:</x-details-dt>
        <x-details-dd>{{ $administrador['email'] }} <a target="_blank" href="mailto:{{$administrador['email']}}" title="Abrir gestor de correo para enviarle un correo electrónico"><i class="fa-solid fa-envelope-open-text text-lg ml-3"></i></a></x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Cédula:</x-details-dt>
        <x-details-dd>
            @if($administrador->nacionalidad === 'VE')
                V -
            @else
                E -
            @endif{{ $administrador['cedula'] }}</x-details-dd>
      </x-details-div>
       <x-details-div>
        <x-details-dt>Genero:</x-details-dt>
        <x-details-dd>{{ $administrador['genero']}}</x-details-dd>
      </x-details-div>
      <x-details-div>
          <x-details-dt>Núcleo De Trabajo:</x-details-dt>
          <x-details-dd>{{ $administrador->nucleos->nucleo }}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Cargo Actual Que Ejerce:</x-details-dt>
        <x-details-dd>{{ $administrador->cargos->cargo }}</x-details-dd>
      </x-details-div>
      <x-details-div>
        <x-details-dt>Titulo Obtenido:</x-details-dt>
        <x-details-dd>{{ strtoupper($administrador->estudios->estudio . ' ' . $administrador->estudios->abrev) }}</x-details-dd>
      </x-details-div>
    </dl>
  </div>
</div>

</x-dashboard>
