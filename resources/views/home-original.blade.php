<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords"
        content="UPTTMBI, excelencia academica, estudios, estudiar, carreras, pregrado, postgrado, pnf, trujillo" />
    <meta name="description"
        content="UPTTMBI - Web es la Pagina Oficial de la Universidad Politécnica Territorial del Estado Trujillo Mario Briceño Iragorry - Trujillo Venezuela">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UPTTMBI - Web</title>
    <link rel="stylesheet" href="{{ asset('node_modules/nprogress/nprogress.css') }}">
    @vite(['resources/css/app.scss'])
    <x-import />
    <!-- CSS Here -->
    <!-- MagnificPopup.css -->
    <link rel="stylesheet" href="/css/magnific-popup.css">
    <link rel="stylesheet" href="/css/menu.css">
    <!-- SlickNav.css -->
    <link rel="stylesheet" href="/css/slicknav.min.css">
    <!-- Owl.carousel.css -->
    <link rel="stylesheet" href="/css/owl.carousel-2.3.4.min.css">
    <!-- Fontawesome.css -->
    <link rel="stylesheet" href="/css/fontawesome-free-5.12.0.min.css">
    <!-- Default.css -->
    <link rel="stylesheet" href="/css/default.css">
    <!-- Style.css -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Responsive.css -->
    <link rel="stylesheet" href="/css/responsive.css">

    <!-- ColorNip.css -->
    <link rel="stylesheet" href="/css/colornip.min.css">
    <!-- Jquery -->
    <script src="resources/js/jquery-3.4.1.min.js"></script>

    <style>
        .banner {
            background-image: url('/img/banner.webp');
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100dvh;
            user-select: none;
        }

        .slide-left-1 {
            font-size: 350%;
            -webkit-animation: slide-left 1s cubic-bezier(0.075, 0.820, 0.165, 1.000) 2s both;
            animation: slide-left 1s cubic-bezier(0.075, 0.820, 0.165, 1.000) 2s both;
        }

        .slide-left-2 {
            font-size: 350%;
            -webkit-animation: slide-left 1s cubic-bezier(0.075, 0.820, 0.165, 1.000) 2.5s both;
            animation: slide-left 1s cubic-bezier(0.075, 0.820, 0.165, 1.000) 2.5s both;
        }

        .slide-left-3 {
            font-size: 250%;
            -webkit-animation: slide-left 1s cubic-bezier(0.075, 0.820, 0.165, 1.000) 3s both;
            animation: slide-left 1s cubic-bezier(0.075, 0.820, 0.165, 1.000) 3s both;
        }

        @-webkit-keyframes slide-left {
            0% {
                -webkit-transform: translateX(100px);
                transform: translateX(100px);
                opacity: 0%;
            }

            100% {
                -webkit-transform: translateX(0px);
                transform: translateX(0px);
                opacity: 100%;
            }
        }

        @keyframes slide-left {
            0% {
                -webkit-transform: translateX(100px);
                transform: translateX(100px);
                opacity: 0%;
            }

            100% {
                -webkit-transform: translateX(0px);
                transform: translateX(0px);
                opacity: 100%;
            }
        }
    </style>

</head>
@viteReactRefresh
@vite('resources/js/app.jsx')
<body class="cuerpo">
    <x-menuuptt />

    <div class="banner">
        <div>
            <h2 class="slide-left-1 text-white text-center">UNIVERSIDAD POLITÉCNICA TERRITORIAL</h2>
            <h2 class="slide-left-2 text-white text-center">DEL ESTADO TRUJILLO</h2>
            <h3 class="slide-left-3 text-white text-center">"MARIO BRICEÑO IRAGORRY"</h1>
        </div>
    </div>
    <section class="sec-about">
        <div class="s-about">
            <h1>Sobre Nosotros</h1>
            <div class="d-about">
                <details open>
                    <summary>Objetivo</summary>
                    <div>
                        <p>La Universidad Politécnica Territorial de estado Trujillo “Mario Briceño Iragorry"
                            desarrollará proyectos y programas académicos de formación, creación intelectual,
                            desarrollo tecnológico, innovación, asesoría y vinculación social en todo el estado
                            Trujillo, en estrecha relación con la Misión Sucre y, a través de alianzas con otras
                            instituciones de educación universitaria.
                            La creación de programas y proyectos
                            responderá a los requerimientos de desarrollo territorial Integral y estará en
                            correspondencia con las necesidades planteadas por del Poder Popular, previa aprobación del
                            Ministerio del Poder Popular para la Educación Universitaria y de cumplimiento de los
                            trámites legales respectivos.
                        </p>
                        <div class="flex justify-center">
                            <x-button-a class="text-lg mt-4 mb-2 mr-2" link="docs/GacetaCreacionUPTTMBI.pdf">
                                Gaceta de Creación UPTTMBI</x-button-a>
                            <x-button-a class="text-lg mt-4 mb-2" link="docs/NORMATIVA-UPTTMBI2017.pdf">
                                Normativa UPTTMBI</x-button-a>
                        </div>
                    </div>
                </details>
                <details>
                    <summary>Encargo Social</summary>
                    <div>
                        <p>La Universidad Politécnica Territorial del estado Trujillo “Mario Briceño Iragorry", tiene
                            como encargo social contribuir activamente al desarrollo endógeno integral y
                            sustentable en su área de influencia territorial, con la participación activa y
                            permanente del Poder Popular, abarcando múltiples campos de conocimiento, bajo
                            enfoques Inter y Transdisciplinarios, para abordar los problemas y retos de su contexto
                            territorial, de acuerdo con las necesidades y potencialidades del pueblo, a
                            partir de las realidades geohistóricas, culturales, sociales y productivas,
                            ayudando a conformar una nueva geopolítica nacional.
                        </p>
                        <div class="flex justify-center">
                            <x-button-a class="text-lg mt-4 mb-2" link="docs/AutoridadesUPTTMBI.pdf">
                                Gaceta Oficial - Autoridades Universitarias</x-button-a>
                        </div>
                    </div>
                </details>

            </div>
        </div>
    </section>


    <!-- Star ReadyGrades Area -->
    <div class="readygrades-all">
        <h1>Ver Tus Notas Académicas</h1>
        <section class="sec-readygrades">
            <div class="readygrades-img">
                <img src="{{ Vite::asset('resources/images/girl-student.webp') }}" alt="">
            </div>
            <div class="readygrades">
                <p>El Área de Registro, Seguimiento y Control de Estudios, en conjunto con el sistema ReadyGrades,
                    desarrollado por estudiantes de Ingeniería en Informática en colaboración con profesionales del área
                    administrativa, se ha implementado una plataforma innovadora para la visualización de calificaciones
                    académicas, destinada a los estudiantes matriculados en nuestra institución.</p>
                <a href="/student"><button class="readylink"><i
                            class="fa-solid fa-user-graduate"></i>Estudiante</button></a>
            </div>
        </section>
    </div>
    <!-- End ReadyGrades Area -->

    <!-- Start Icon Box Area -->
    <div class="icon-box-area pt-70 pb-70" id="feature">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-icon-box icon-box-img-1">
                        <div class="icon-box-content" href="nucleos.html">
                            <h6 class="iconbox-content-heading"><i class="fas fa-university"></i> Núcleos
                                Territoriales</h6>
                            <div class="iconbox-content-body">
                                <p>Espacios Educativos abiertos al aprendizaje colaborativo del estudiantado Trujillano.
                                    Ubicados en 5 Municipios del Estado Trujillo.</p>
                                <x-button-a class="border-2 w-[100%]" link="nucleos.html" icon="fas fa-plus-square">
                                    Ver más
                                </x-button-a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-icon-box icon-box-img-2">
                        <div class="icon-box-content">
                            <div class="iconbox-content-body">
                                <h6 class="iconbox-content-heading"><i class="fas fa-book-reader"></i> Programas
                                    Nacionales de Formación</h6>
                                <p>Conjunto de estudios en áreas estratégicas para la Patria, conducentes a títulos o
                                    grados
                                    de estudios universitarios, creados por iniciativa del Ejecutivo Nacional, a través
                                    del
                                    Ministerio del Poder Popular para la Educación Universitaria (MPPEU)</p>
                                <div class="iconbox-content-body">
                                    <x-button-a class="border-2 w-[100%]" link="pnf/index.html"
                                        icon="fas fa-plus-square">
                                        Ver más
                                    </x-button-a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-icon-box icon-box-img-3">
                        <div class="icon-box-content">
                            <div class="iconbox-content-body">
                                <h6 class="iconbox-content-heading"><i class="fas fa-user-graduate"></i> DRSCE</h6>
                                <p>Departamento de Registo, Seguimiento y Control de Estudios. Instancia encargada de
                                    organizar, programar, ejecutar y supervisar el proceso de admisión, prosecución y
                                    egreso, asesoramiento estudiantil y profesoral, control de estudios y evaluación en
                                    la Universidad.</p>
                                <x-button-a class="border-2 w-[100%]" link="drsce/drsce.html" icon="fas fa-plus-square">
                                    Ver más
                                </x-button-a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Icon Box Area -->
    <!-- ARC -->
    <div class="hire-us-area theme-bg js--sticky-menu">
        <div class="container">
            <div class="flex items-center justify-center">
                <div class="max-w-[55%]">
                    <center>
                        <div class="hire-us-content">
                            <h6><b>Trabajador UPETISTA, OTIC y OGH activan el sistema de descarga de la Planilla ARC
                                    para el pago de Impuesto Sobre la Renta. Ingresa y descargarla en el siguiente
                                    enlace.<b></h6>
                        </div>
                    </center>
                </div>
                <div class="ml-5">
                    <x-button-a class="text-xl" link="https://www.upttmbi.edu.ve/constancias/arc_upttmbi2023.php"
                        target="_blank" icon="fa fa-download fa-lg" style="border: 2px solid #fff;">Sistema ARC
                        UPTTMBI</x-button-a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hire Us Area -->

    <!-- Start Barra Download -->
    {{-- <div class="hire-us-area theme-bg js--sticky-menu"> --}}
    {{--     <div class="container"> --}}
    {{--         <div class="row"> --}}
    {{--             <div class="col-lg-7 col-md-9 col-12"><center> --}}
    {{--                 <div class="hire-us-content"> --}}
    {{--                     <h6><b>NORMATIVA INTERNA SOBRE LOS CONCURSOS PARA INGRESO Y ASCENSO DE CARGO DEL PERSONAL ADMINISTRATIVO Y OBRERO DE LA UPTTMBI<b></h6> --}}
    {{--                 </div> --}}
    {{--             </center></div> --}}
    {{--             <div class="col-lg-3 col-md-3  offset-lg-2 col-12 text-right"> --}}
    {{--                 <a class="btn hire-us-button" href="docs/Normativa Int Asc Adm Ob.pdf" target="_blank">&nbsp;DESCARGA&nbsp;<i class="fas fa-download"></i></a> --}}
    {{-- --}}
    {{--                 <a class="btn hire-us-button" href="https://forms.gle/pgE4MCZx7typvyC68" target="_blank"><i class="fas fa-user-friends"></i>&nbsp;ACTUALIZACION FAMILIAR UPTTMBI&nbsp;<i class="fas fa-external-link-alt"></i></a -- --}}
    {{--             </div> --}}
    {{--         </div> --}}
    {{--     </div> --}}
    {{-- </div> --}}
    <!-- End Hire Us Area -->

    <!-- Start We are Bemax Area -->
    <div class="bemax-area gray-bg pt-65 pb-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-70">
                    <div class="section-title">
                        <h4>Enlaces UPTTMBI</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-bemax-item d-flex">
                        <div class="item-icon">
                            <img src="/img/AulaVirtual.webp" width="400px" height="100px"></img>
                        </div>
                        <div class="item-content">
                            <h6><a href="http://www.moodle2.iutetvirtual.org.ve/" target="_blank">MOODLE UPTTMBI</a>
                            </h6>
                            <p>El Aula Virtual de la UPTTMBI, es el espacio para las actividades de docencia y educación
                                usando las Tecnologías de Información y Comunicación.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-bemax-item d-flex">
                        <div class="item-icon">
                            <img src="/img/censoiuptt.webp" width="200px" height="100px">
                        </div>
                        <div class="item-content">
                            <h6><a href="https://docs.google.com/forms/d/e/1FAIpQLScvXQKh0b1QaoXAtrvXCCEBajD-RjkvJQl98vMiMyiArvQkvw/viewform"
                                    target="_blank">Creación Intelectual y Desarrollo Socio Productivo</a></h6>
                            <p>Censo de Investigadores Académicos de la UPTTMBI</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-bemax-item d-flex">
                        <div class="item-icon">
                            <img src="/img/sismeu.webp" width="200px" height="100px">
                        </div>
                        <div class="item-content">
                            <h6><a href="https://hcmupttmbi.blogspot.com/" target="_blank">SISMEU</a></h6>
                            <p>Informacion Servicio HCM de la Universidad</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-bemax-item d-flex">
                        <div class="item-icon">
                            <img src="/img/turadio1079.webp" width="100px" height="100px">
                        </div>
                        <div class="item-content">
                            <h6><a href="#">TU RADIO 107.9FM</a></h6>
                            <p>Trujillana Universitaria, Radio UPTTMBI</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-bemax-item d-flex">
                        <div class="item-icon">
                            <img src="/img/recibospagos.webp" width="200px" height="100px">
                        </div>
                        <div class="item-content">
                            <h6><a href="http://www.upttmbi.edu.ve/constancias/constancia.php"
                                    target="_blank">Constancias Personal UPTTMBI</a></h6>
                            <p>Sistema Web de la Oficina de Gestión Humana para el Personal de la UPTTMBI</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-bemax-item d-flex">
                        <div class="item-icon">
                            <img src="/img/logouptt.webp" width="200px" height="100px">
                        </div>
                        <div class="item-content">
                            <h6><a href="/img/cintilloUPTT.jpg" target="_blank">Encabezado de Publicaciones</a>
                            </h6>
                            <p>Cintillo Institucional, diseñado para su uso en papelería y trabajos de la Universidad
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- En Galery -->

    <!-- Start Barra Download -->
    <div class="hire-us-area theme-bg js--sticky-menu">
        <div class="container">
            <div class="flex items-center justify-center">
                <div class="max-w-[55%]">
                    <center>
                        <div class="hire-us-content">
                            <h6><b>Estudiante Nuevo Ingreso <br>Ingresa, descarga, llena e imprime tu planilla de
                                    inscripción en el siguiente enlace...<b></h6>
                        </div>
                    </center>
                </div>
                <div class="ml-5">
                    <x-button-a class="text-xl" link="drsce/drsce.html" target="_blank" icon="fa fa-download fa-lg"
                        style="border: 2px solid #fff;">
                        ADMISION 2025-3
                    </x-button-a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hire Us Area -->



    <!-- Start Oferta Académica Area -->
    <div class="bemax-area gray-bg pt-65 pb-25 flex">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-70">
                    <div class="section-title">
                        <h4>INSCRIPCIÓN ESTUDIANTES NUEVO INGRESO <br>PERÍODO ACADÉMICO 2025-3</h4>
                    </div>
                </div>
            </div>

            <div id="insta-post-1" data-instagram-url='https://www.instagram.com/p/DOuda_XkbZx/'></div>
        </div>

        <div
            class="
                after:block
                after:bg-gray-500
                after:w-[1px]
                after:h-[100%]
                after:mx-auto
                after:my-2">
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-70">
                    <div class="section-title">
                        <h4>Inscripciones Período Académico 2025-3 REGULARES</h4>
                    </div>
                </div>
            </div>

            <div id="insta-post-2" data-instagram-url='https://www.instagram.com/p/DOlzfkckeGy/'></div>
        </div>
    </div>

    <!-- End Working With Us Area -->

    <br>

    <!-- Start Why Choose Us Area -->
    <div class="choose-us-area pt-70 pb-70" id="page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-70">
                    <div class="section-title">
                        <h4>Academia UPTTMBI</h4>
                    </div>
                </div>
            </div>

            <div class="row flex items-center">
                <div class="col-lg-6">
                    <iframe width="100%" height="420px" src="https://www.youtube.com/embed/Ilb2Zc2l4u0"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
                </div>
                <div class="col-lg-6">
                    <div class="single-choose-item">
                        <h6><a href="#"><i class="fas fa-cogs"></i> Trabajo Colaborativo</a></h6>
                        <p>Esta forma de estudio no se basa simplemente en la estructura lineal docente – estudiante,
                            sino que gracias a la posibilidad de utilizar la web se agregan contenidos multimedia que
                            facilitan el aprendizaje, además de la oportunidad de intercambiar información con
                            compañeros de otras culturas que se encuentran en otro lado del planeta.</p>
                    </div>
                    <!--div class="single-choose-item">
                        <h6><a href="#"><i class="fas fa-home"></i> Desde Casa </a></h6>
                        <p>Estudiar desde casa te da la posibilidad de elegir la cantidad de tiempo que deseas invertir en el estudio.  De igual forma, puedes aprender una lección o poner en práctica las tutorías al momento que realizas cualquier actividad en tu hogar.</p>
                    </div-->
                    <div class="single-choose-item">
                        <h6><a href="#"><i class="fas fa-book"></i> Educación Multimodal</a></h6>
                        <p>La educación multimodal implica atender a diferentes estilos de aprendizaje. A través del
                            estudio desde casa utilizado las TICs o asesorias a través de nuestra plaforma MOODLE y
                            clases presenciales en la institución.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Why Choose Us Area -->


    <!-- Start Working With Us Area -->
    {{-- <div class="working-with-us-area gray-bg"> --}}
    {{--     <div class="container"> --}}
    {{--         <div class="row"> --}}
    {{--             <div class="col-md-6 col-12 text-center d-flex align-items-center"> --}}
    {{--                 <div class="hire-us-content"> --}}
    {{--                     <div class="section-title"> --}}
    {{--                         <h4>CENSO PNF EN INGENIERÍA INDUSTRIAL</h4> --}}
    {{--                     </div> --}}
    {{--                     <p>Bachiller Trujillano, accede al siguiente enlace llena el formulario y postulate a cursar estudios en el PNF en Ingeniería Industrial en el Núcleo San Luis y Núcleo El Dividive de nuestra Casa de Estudios Univertsitarios</p> --}}
    {{--                     <a href="https://forms.gle/jYggQHag7criaskW6" target="_blank" class="btn hire-us-btn">LINK CENSO</a> --}}
    {{--                 </div> --}}
    {{--             </div> --}}
    {{--             <div class="col-md-6 d-none d-md-block"> --}}
    {{--                 <div class="hire-us-img"> --}}
    {{--                     <img src="assets\img\gallery2/CensoPNFInd.jpg" height="100%" alt=""> --}}
    {{--                 </div> --}}
    {{--             </div> --}}
    {{--         </div> --}}
    {{--     </div> --}}
    {{-- </div> --}}
    <!-- End Working With Us Area -->

    <!-- Start Oferta Académica Area -->
    {{-- <div class="bemax-area gray-bg pt-65 pb-25"> --}}
    {{--     <div class="container"> --}}
    {{--         <div class="row"> --}}
    {{--             <div class="col-lg-12 text-center mb-70"> --}}
    {{--                 <div class="section-title"> --}}
    {{--                     <h4>10 Aniversario UPTTMBI</h4> --}}
    {{--                 </div> --}}
    {{--             </div> --}}
    {{--         </div> --}}
    {{-- --}}
    {{--         <div class="row no-gutters"> --}}
    {{--             <div class="col-12"> --}}
    {{--                 <div class="slider-carousel owl-carousel"> --}}
    {{--                     <div><img src="imagen/CXBOC.jpg" width="50%" height="700px"></div> --}}
    {{--                     <div><img src="imagen/XAniv.jpg" width="50%" height="700px"></div> --}}
    {{--                     <div><img src="imagen/CXSANL.jpg" width="50%" height="700px"></div> --}}
    {{--                 </div> --}}
    {{--                 </div> --}}
    {{--         </div> --}}
    {{--     </div> --}}
    {{-- </div> --}}
    <!-- End Working With Us Area -->

    <!-- Start Latest Project Area -->
    {{--     <div class="latest-project-area black-bg pt-70 pb-70" id="portfolio"> --}}
    {{--         <div class="container"> --}}
    {{--    <div class="row"> --}}
    {{--    <div class="col-lg-12 text-center mb-70"> --}}
    {{--                     <div class="section-title"> --}}
    {{--                         <h4>INSCRIPCIÓN ESTUDIANTES REGULARES <BR> PERIODO 2024-1</h4> --}}
    {{--                     </div> --}}
    {{--                 </div> --}}
    {{--             </div> --}}
    {{-- --}}
    {{--   <div class="row"> --}}
    {{--    <div> --}}
    {{--                 <center><b><h4 style="color: white">REGULARES 2024-1</h4></b></center> --}}
    {{--                 <a href="imagen/24-1/regboc.jpg" rel="shadowbox"><img src="imagen/24-1/regboc.jpg" width="350px" height="450px"></a> --}}
    {{--                 <p align='center' style="color: white"><b>DRSCE</b></p> --}}
    {{--             </div>&nbsp;&nbsp;&nbsp; --}}
    {{--    <div> --}}
    {{--                 <center><b><h4 style="color: white">REGULARES 2024-1</h4></b></center> --}}
    {{--                 <a href="imagen/24-1/regdiv.jpg" rel="shadowbox"><img src="imagen/24-1/regdiv.jpg" width="350px" height="450px"></a> --}}
    {{--                 <p align='center' style="color: white"><b>DRSCE</b></p> --}}
    {{--             </div>&nbsp;&nbsp;&nbsp; --}}
    {{--    <div> --}}
    {{--                 <center><b><h4 style="color: white">REGULARES 2024-1</h4></b></center> --}}
    {{--                 <a href="imagen/24-1/reglab.jpg" rel="shadowbox"><img src="imagen/24-1/reglab.jpg" width="350px" height="450px"></a> --}}
    {{--                 <p align='center' style="color: white"><b>DRSCE</b></p> --}}
    {{--             </div>&nbsp;&nbsp;&nbsp; --}}
    {{--    <div> --}}
    {{--                 <center><b><h4 style="color: white">REGULARES 2024-1</h4></b></center> --}}
    {{--                 <a href="imagen/24-1/regsanl.jpg" rel="shadowbox"><img src="imagen/24-1/regsanl.jpg" width="350px" height="450px"></a> --}}
    {{--                 <p align='center' style="color: white"><b>DRSCE</b></p> --}}
    {{--             </div>&nbsp;&nbsp;&nbsp; --}}
    {{--    <div> --}}
    {{--                 <center><b><h4 style="color: white">REGULARES 2024-1</h4></b></center> --}}
    {{--                 <a href="imagen/24-1/regdtruj.jpg" rel="shadowbox"><img src="imagen/24-1/regtruj.jpg" width="350px" height="450px"></a> --}}
    {{--                 <p align='center' style="color: white"><b>DRSCE</b></p> --}}
    {{--             </div>&nbsp;&nbsp;&nbsp; --}}
    {{--    <div> --}}
    {{--                 <center><b><h4 style="color: white">REGULARES 2024-1</h4></b></center> --}}
    {{--                 <a href="imagen/24-1/regcar.jpg" rel="shadowbox"><img src="imagen/24-1/regcar.jpg" width="350px" height="450px"></a> --}}
    {{--                 <p align='center' style="color: white"><b>DRSCE</b></p> --}}
    {{--             </div>&nbsp;&nbsp;&nbsp; --}}
    {{-- --}}
    {{-- --}}
    {{--   </div> --}}
    {{--   </div> --}}
    {{--     </div> --}}
    {{-- <br><br> --}}
    <!-- End Gallery Area -->


    <!-- Start Working With Us Area -->
    <div class="working-with-us-area gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12 text-center d-flex align-items-center">
                    <div class="hire-us-content">
                        <div class="section-title">
                            <h4>CONSIGNACIÓN DE FE DE VIDA 2025</h4>
                        </div><br>
                        <div class="section-title">
                            <h4>PERSONAL JUBILADO, INCAPACITADO Y/O PENSIONADO UPETISTA</h4>
                        </div>
                        <p>Accede al siguiente enlace para descargar el formato de declaración jurada</p>
                        <x-button-a link="docs/DECLARACION_JURADA_PERSONAL_JPS.docx" target="_blank">AQUÍ</x-button-a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="insta-post-2" data-instagram-url='https://www.instagram.com/p/DEx2BE9RL8L/'></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Working With Us Area -->

    <!-- Start Footer Area -->
    <x-footer-original />
</body>
</html>
