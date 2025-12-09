<link rel="stylesheet" href="/css/menu.css">
<link rel="stylesheet" href="/css/style.css">


<!-- navbar en modo escritorio -->
<nav class="navbar menu block">
     <div class="menus justify-between items-center">
         <div class="w-[15%]">
             <a href="/">
                 <img src="/cintilloUPTT2.webp">
             </a>
         </div>
         <div class="text-center">
             <nav class="menu-wrapper nav">
                 <ul class="main-menu nav uppercase" id="mobile-menu">
                     <li><a href="/" class="{{ request()->is('/') ? 'text-ready' : '' }}">INICIO</a></li>
                     <li><a href="/autoridades" class="{{ request()->is('autoridades') ? 'text-ready' : '' }}">AUTORIDADES</a></li>
                     <li><a href="/nucleo" class="{{ request()->is('nucleo') ? 'text-ready' : '' }}">NÚCLEOS</a></li>
                     {{-- <li><a href="pnf/index.html">PNF</a></li> --}}
                     {{-- <li><a href="drsce/drsce.html">DRSCE</a></li> --}}
                     <li><a href="/student" class="{{ request()->is('student') ? 'text-ready' : '' }}">estudiante</a></li>
                     <li><a href="/login" class="{{ request()->is('login') ? 'text-ready' : '' }}">iniciar sesión</a></li>
                 </ul>
             </nav>
         </div>
         <div class="w-[5%]">
             <a href="/">
                 <img src="/img/200.webp">
             </a>
         </div>
     </div>
 </nav>




<!-- menu oculto movil -->
<div class="sidebar-overlay fixed inset-0 z-[4] bg-black opacity-0 transition-opacity duration-300 pointer-events-none md:hidden"></div>
<div class="menusidebar sidebar-movil -translate-x-96 flex md:hidden flex-col w-64 fixed z-[5] h-screen transition-transform duration-300 ease-in-out">
        <button type="button" class="close-sidebar-movil text-3xl max-w-fit mb-4 ml-[80%]">
            <i class="fal fa-times"></i>
        </button>
    <div class="flex flex-col flex-1 overflow-y-auto">
    <ul class="flex-1 px-2 py-4 mr-4 uppercase mobile-divider" id="mobile-menu">
        <li class="py-2"><a href="/" class="block {{ request()->is('/') ? 'text-ready' : '' }}">INICIO</a></li>
        <li class="py-2"><a href="/autoridades" class="block {{ request()->is('autoridades') ? 'text-ready' : '' }}">AUTORIDADES</a></li>
        <li class="py-2"><a href="/nucleo" class="block {{ request()->is('nucleo') ? 'text-ready' : '' }}">NÚCLEOS</a></li>
        <li class="py-2"><a href="/student" class="block {{ request()->is('student') ? 'text-ready' : '' }}">estudiante</a></li>
        <li class="py-2"><a href="/login" class="block {{ request()->is('login') ? 'text-ready' : '' }}">iniciar sesión</a></li>
    </ul>
    </div>
</div>




<!-- navbar en modo movil -->
<nav class="movilmenu block">
     <div class="menus justify-between items-center">
         <div class="max-w-[150px]">
             <a href="/">
                 <img src="/cintilloUPTT2.webp">
             </a>
         </div>
            <!-- Boton para brir el menu -->
             <button type="button" class="menu-hiden-button text-3xl">
                 <i class="fas fa-bars"></i>
             </button>
     </div>
 </nav>
 <script>
     // Espera a que el DOM (Document Object Model) esté cargado
     document.addEventListener('DOMContentLoaded', function() {
         // Selecciona el elemento del menú
         const menu = document.querySelector('.menu');

         // Agrega un evento 'scroll' a la ventana
         window.addEventListener('scroll', function() {
             // Si el desplazamiento vertical (scrollY) es mayor que 50px...
             if (window.scrollY > 50) {
                 // ...añade la clase 'menu-encogido'
                 menu.classList.add('menu-encogido');
             } else {
                 // ...si no, quita la clase 'menu-encogido'
                 menu.classList.remove('menu-encogido');
             }
         });
     });
 </script>
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
