<div class="menu block">
     <div class="menus justify-between items-center">
         <div class="w-[15%]">
             <a href="/">
                 <img src="/cintilloUPTT2.webp">
             </a>
         </div>
         <div class="text-center">
             <nav class="menu-wrapper nav">
                 <ul class="main-menu nav" id="mobile-menu">
                     <li class="!ml-0"><a href="/">INICIO</a></li>
                     <li><a href="autoridades.html">AUTORIDADES</a></li>
                     <li><a href="nucleos/index.html">NÚCLEOS</a></li>
                     <li><a href="pnf/index.html">PNF</a></li>
                     <li><a href="drsce/drsce.html">DRSCE</a></li>
                     <li><a href="#contact-us">CONTACTO</a></li>
                     <li><a href="/login">LOGIN</a></li>
                 </ul>
             </nav>
         </div>
         <div class="w-[5%]">
             <a href="/">
                 <img src="/200.png">
             </a>
         </div>
     </div>
 </div>
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
