<link rel="stylesheet" href="/css/menu.css">
<link rel="stylesheet" href="/css/style.css">
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
                     <li><a href="nucleos/index.html">NÚCLEOS</a></li>
                     <li><a href="pnf/index.html">PNF</a></li>
                     <li><a href="drsce/drsce.html">DRSCE</a></li>
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
