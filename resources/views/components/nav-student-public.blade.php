<div class="nav-data-public-student">
    <section class="components-data-public-student max-[840px]:hidden">
        <div class="head-data-public-student">
            <p class="data-public-student">Datos Generales de {{ $usuario }}</p>
            <button id="exit" class="exit" title="Volver / Salir"><i class="fa-solid fa-arrow-right-from-bracket m-0"></i></button>
        </div>
        <div class="views-button-data-public-student">
            <button class="student-nav overview active-button"><i class="fas fa-user-graduate"></i>Descripción General</button>
            <button class="student-nav score"><i class="fas fa-award"></i>Calificaciones</button>
            <button class="student-nav constancia"><i class="fa-solid fa-download"></i>Constancia De Estudio</button>
            @if ($fechaInscripcion !== null)
                @if(!$fechaInscripcion->isPast())
                    <button class="student-nav inscripcion"><i class="fas fa-bell-school"></i>Inscripción</button>
                @endif
            @endif
        </div>
    </section>
    <section class="components-data-public-student min-[840px]:hidden">
        <div class="head-data-public-student">
            <button class="menu-hiden-button ml-auto hover:bg-[#0f2167] px-3 rounded-md"><i class="fas fa-bars m-0"></i></button>
        </div>
    </section>
</div>

<div class="sidebar-overlay fixed inset-0 z-[4] bg-black opacity-0 transition-opacity duration-300 pointer-events-none md:hidden"></div>
    <div class="menusidebar sidebar-movil bg-ready -translate-x-96 w-64 fixed z-[5] h-screen transition-transform duration-300 ease-in-out">
        <div class="flex md:hidden flex-col">
        <button type="button" class="close-sidebar-movil text-3xl max-w-fit mb-4 ml-auto mr-4 mt-4">
            <i class="fal fa-times text-white"></i>
        </button>
        <div class="views-button-data-public-student ml-4 space-y-8">
            <button class="student-nav overview active-button">Descripción General</button>
            <button class="student-nav score hover:!border-b-0">Calificaciones</button>
            <button class="student-nav constancia hover:!border-b-0">Constancia De Estudio</button>
            @if ($fechaInscripcion !== null)
                @if(!$fechaInscripcion->isPast())
                    <button class="student-nav inscripcion hover:!border-b-0">Inscripción</button>
                @endif
            @endif
        </div>
        </div>
        <button class="exit uppercase text-white rounded-3xl p-2 bg-[#0f2167] mt-8 w-[112px] ml-4">Salir<i class="fa-solid fa-arrow-right-from-bracket m-0 ml-2"></i></button>
    </div>
</div>
 <script>
    let overlay = document.querySelector('.sidebar-overlay');
    let movilBtn = document.querySelector('.menu-hiden-button');
    let sidebar = document.querySelector('.sidebar-movil');
    let closeBar = document.querySelector('.close-sidebar-movil');

        movilBtn.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-96');
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            overlay.classList.add('opacity-50');
        });

        closeBar.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-96');
            overlay.classList.remove('opacity-50');
            overlay.classList.add('opacity-0', 'pointer-events-none');
        });

        overlay.addEventListener('click', () => {
            closeBar.click();
        });
</script>
