<div class="py-10 sm:py-10">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-2xl lg:max-w-none">
      <div class="text-center">
        <h2 class="text-3xl font-bold tracking-tight sm:text-4xl font-inter">Metricas de la institución</h2>
        <p class="mt-4 text-lg leading-8 font-inter">
            Un resmuen general de la actividad anual del registro y control de estudios de la institución
        </p>
      </div>
      <dl class="mt-16 grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center sm:grid-cols-2 lg:grid-cols-3">
        <a href="/estudiantes-panel-administrativo" class="flex flex-col bg-emerald-100 p-8 hover:bg-emerald-200 ease-in-out duration-200">
          <dt class="text-sm font-semibold leading-6 text-gray-600 font-inter">Estudiantes Registrados</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 font-inter">{{ $estudiantes }}</dd>
        </a>
        <a href="/carreras" class="flex flex-col bg-indigo-100 p-8 hover:bg-indigo-200 ease-in-out duration-200">
          <dt class="text-sm font-semibold leading-6 text-gray-600 font-inter">Carreras Activas</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 font-inter">{{ $carreras }}</dd>
        </a>
        <a href="/nucleos" class="flex flex-col bg-amber-100 p-8 hover:bg-amber-200 ease-in-out duration-200">
          <dt class="text-sm font-semibold leading-6 text-gray-600 font-inter">Núcleos Universitarios</dt>
          <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900 font-inter">{{ $nucleos }}</dd>
        </a>
      </dl>
    </div>
  </div>
</div>
