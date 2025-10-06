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
    {{-- <style> --}}
    {{--     .ocultar-elementos-ig .Footer{ --}}
    {{--         display: none !important; --}}
    {{--     } --}}
    {{----}}
    {{--     .ocultar-elementos-ig .Caption{ --}}
    {{--         display: none !important; --}}
    {{--     } --}}
    {{----}}
    {{--     .ocultar-elementos-ig .SocialProof{ --}}
    {{--         display: none !important; --}}
    {{--     } --}}
    {{----}}
    {{--     .ocultar-elementos-ig .Feedback{ --}}
    {{--         display: none !important; --}}
    {{--     } --}}
    {{-- </style> --}}
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
    <link id="theme" rel="stylesheet" href="resources/css/theme-colors/theme-default.css">

    <!-- Jquery -->
    <script src="resources/js/jquery-3.4.1.min.js"></script>

    {{-- <script src="../../cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script> --}}

    <link rel="stylesheet" href="/css/shadowbox.css">

    <script src="resources/shadow/js/shadowbox.js"></script>
    <!--script type="text/javascript">
Shadowbox.init({ language: "es", players:  ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'] });

setTimeout(function() {
    Shadowbox.open({
        content: '<div class="example"><img src="imagen/2023-2/1.jpg" rel="shadowbox"></div>',
    player:     "html",
    title:      "UPTTMBI WEB",
    height:     878, //655 //375
   width:		655 //870 //345
    });
}, 50);

</script-->

    <link rel="stylesheet" type="text/css" href="shadowbox.css">
    <script type="text/javascript" src="shadowbox.js"></script>
    <script type="text/javascript">
        Shadowbox.init();
    </script>

    <script type="text/javascript">
        $(function() {
            $('#portfolio').magnificPopup({
                delegate: 'z',
                type: 'image',
                image: {
                    cursor: null,
                    titleSrc: 'title'
                },
                gallery: {
                    enabled: true,
                    preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
                    navigateByImgClick: true
                }
            });
        });
    </script>
</head>
<body class="cuerpo">
    <!-- Start Header Area -->
    <x-menuuptt />
    <!-- End Header Area -->
    <!-- Start Slider Area -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true"
        data-bs-pause="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner font-inter">
            <div class="carousel-item active" data-bs-interval="7000">
                <img src="/img/slide_01.webp" class="d-block w-100 filtro" alt="...">
                <div class="carousel-caption">
                    <h5 class="text-6xl font-bold">
                        {{ ucwords('universidad politécnica territorial del estado trujillo') }}</h5>
                    <p class="text-4xl"><b>"{{ ucwords('mario briceño iragorry') }}"</b></p>
                </div>
            </div>
            <div class="carousel-item carousel-custom" data-bs-interval="7000">
                <img src="/img/slide_02.webp" class="d-block w-100 filtro" alt="...">
                <div class="carousel-caption">
                    <h3 style="color: yellow">
                        <b>OBJETIVO</b>
                    </h3>
                    <h5 class="text-lg">
                        <b>La Universidad Politécnica Territorial de estado Trujillo “Mario Briceño Iragorry"
                            desarrollará proyectos y programas académicos de formación, creación intelectual,
                            desarrollo tecnológico, innovación, asesoría y vinculación social en todo el estado
                            Trujillo, en estrecha relación con la Misión Sucre y, a través de alianzas con otras
                            instituciones de educación universitaria.
                            <br><br>La creación de programas y proyectos
                            responderá a los requerimientos de desarrollo territorial Integral y estará en
                            correspondencia con las necesidades planteadas por del Poder Popular, previa aprobación del
                            Ministerio del Poder Popular para la Educación Universitaria y de cumplimiento de los
                            trámites legales respectivos.
                        </b>
                    </h5>
                    <x-button-a class="text-lg mt-4 mb-2" link="docs/GacetaCreacionUPTTMBI.pdf">
                        Gaceta de Creación UPTTMBI</x-button-a>
                    <x-button-a class="text-lg mt-4 mb-2" link="docs/NORMATIVA-UPTTMBI2017.pdf">
                        Normativa UPTTMBI</x-button-a>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="7000">
                <img src="/img/slide_03.webp" class="d-block w-100 filtro" alt="...">
                <div class="carousel-caption">
                    <h3 style= "color: yellow">
                        <b>ENCARGO SOCIAL</b>
                    </h3>
                    <h5 class="text-lg">
                        <b>La Universidad Politécnica Territorial del estado Trujillo “Mario Briceño Iragorry", tiene
                            como encargo social contribuir activamente al desarrollo endógeno integral y
                            sustentable en su área de influencia territorial, con la participación activa y
                            permanente del Poder Popular, abarcando múltiples campos de conocimiento, bajo
                            enfoques Inter y Transdisciplinarios, para abordar los problemas y retos de su contexto
                            territorial, de acuerdo con las necesidades y potencialidades del pueblo, a
                            partir de las realidades geohistóricas, culturales, sociales y productivas,
                            ayudando a conformar una nueva geopolítica nacional.
                        </b>
                    </h5>
                    <x-button-a class="text-lg mt-4 mb-2" link="docs/AutoridadesUPTTMBI.pdf">
                        Gaceta Oficial - Autoridades Universitarias</x-button-a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- End Slider Area -->
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
                                <x-button-a class="border-2 w-[100%]" link="drsce/drsce.html"
                                    icon="fas fa-plus-square">
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
                    <x-button-a class="border-2 text-xl"
                        link="https://www.upttmbi.edu.ve/constancias/arc_upttmbi2023.php" target="_blank"
                        icon="fa fa-download fa-lg">Sistema ARC UPTTMBI</x-button-a>
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
                    <x-button-a class="border-2 text-xl" link="drsce/drsce.html" target="_blank"
                        icon="fa fa-download fa-lg">
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

            <div class="row justify-content-center">
                <div class="ocultar-elementos-ig col-md-8 text-center">
                    <iframe
                        src="https://www.instagram.com/p/DOuda_XkbZx/embed/?hidecaption=true"
                        width="auto"
                        height="480"
                        frameborder="0"
                        scrolling="no"
                        allowtransparency="true"
                        allowfullscreen="true">
                    </iframe>
                </div>
            </div>
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

            <div class="row justify-content-center">
                <div class="ocultar-elementos-ig col-md-8 text-center">
                    <iframe
                        src="https://www.instagram.com/p/DOlzfkckeGy/embed/?hidecaption=true"
                        width="auto"
                        height="480"
                        frameborder="0"
                        scrolling="no"
                        allowtransparency="true"
                        allowfullscreen="true">
                    </iframe>
                </div>
            </div>
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
                    <iframe
                        src="https://www.instagram.com/p/DEx2BE9RL8L/embed/?hidecaption=true"
                        width="auto"
                        height="480"
                        frameborder="0"
                        scrolling="no"
                        allowtransparency="true"
                        allowfullscreen="true">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
    <script>
    </styledocument.addEventListener('DOMContentLoaded', function() {
    const footer = document.querySelector('.Footer');
    const caption = document.querySelector('.Caption');
    const socialProof = document.querySelector('.SocialProof');
    const feedback = document.querySelector('.Feedback');

    if (footer) footer.style.display = 'none';
    if (caption) caption.style.display = 'none';
    if (socialProof) socialProof.style.display = 'none';
    if (feedback) feedback.style.display = 'none';
});
</script>
    <!-- End Working With Us Area -->

    <!-- Start Footer Area -->
    <x-footer-original />
</body>
</html>
