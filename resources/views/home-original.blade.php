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
    <link id="theme" rel="stylesheet" href="resources/css/theme-colors/theme-default.css">

    <!-- Jquery -->
    <script src="resources/js/jquery-3.4.1.min.js"></script>

    <script src="../../cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>

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
                <div class="col-md-8 text-center">
                    <blockquote class="instagram-media" data-instgrm-captioned
                        data-instgrm-permalink="https://www.instagram.com/p/DOuda_XkbZx/?utm_source=ig_embed&amp;utm_campaign=loading"
                        data-instgrm-version="14"
                        style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                        <div style="padding:16px;"> <a
                                href="https://www.instagram.com/p/DOuda_XkbZx/?utm_source=ig_embed&amp;utm_campaign=loading"
                                style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;"
                                target="_blank">
                                <div style=" display: flex; flex-direction: row; align-items: center;">
                                    <div
                                        style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;">
                                    </div>
                                    <div
                                        style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                                        <div
                                            style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;">
                                        </div>
                                        <div
                                            style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;">
                                        </div>
                                    </div>
                                </div>
                                <div style="padding: 19% 0;"></div>
                                <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg
                                        width="50px" height="50px" viewBox="0 0 60 60" version="1.1"
                                        xmlns="https://www.w3.org/2000/svg"
                                        xmlns:xlink="https://www.w3.org/1999/xlink">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                                                <g>
                                                    <path
                                                        d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg></div>
                                <div style="padding-top: 8px;">
                                    <div
                                        style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">
                                        Ver esta publicación en Instagram</div>
                                </div>
                                <div style="padding: 12.5% 0;"></div>
                                <div
                                    style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
                                    <div>
                                        <div
                                            style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);">
                                        </div>
                                        <div
                                            style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;">
                                        </div>
                                        <div
                                            style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);">
                                        </div>
                                    </div>
                                    <div style="margin-left: 8px;">
                                        <div
                                            style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;">
                                        </div>
                                        <div
                                            style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)">
                                        </div>
                                    </div>
                                    <div style="margin-left: auto;">
                                        <div
                                            style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);">
                                        </div>
                                        <div
                                            style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);">
                                        </div>
                                        <div
                                            style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);">
                                        </div>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;">
                                    <div
                                        style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;">
                                    </div>
                                    <div
                                        style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;">
                                    </div>
                                </div>
                            </a>
                            <p
                                style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">
                                <a href="https://www.instagram.com/p/DOuda_XkbZx/?utm_source=ig_embed&amp;utm_campaign=loading"
                                    style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;"
                                    target="_blank">Una publicación compartida de UPTTMBI_OFICIAL (@upttmbi)</a></p>
                        </div>
                    </blockquote>
                    <script async src="https://www.instagram.com/embed.js"></script>
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
                <div class="col-md-8 text-center">
                    <blockquote class="instagram-media" data-instgrm-captioned
                        data-instgrm-permalink="https://www.instagram.com/p/DOlzfkckeGy/?utm_source=ig_embed&amp;utm_campaign=loading"
                        data-instgrm-version="14"
                        style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                        <div style="padding:16px;"> <a
                                href="https://www.instagram.com/p/DOlzfkckeGy/?utm_source=ig_embed&amp;utm_campaign=loading"
                                style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;"
                                target="_blank">
                                <div style=" display: flex; flex-direction: row; align-items: center;">
                                    <div
                                        style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;">
                                    </div>
                                    <div
                                        style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                                        <div
                                            style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;">
                                        </div>
                                        <div
                                            style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;">
                                        </div>
                                    </div>
                                </div>
                                <div style="padding: 19% 0;"></div>
                                <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg
                                        width="50px" height="50px" viewBox="0 0 60 60" version="1.1"
                                        xmlns="https://www.w3.org/2000/svg"
                                        xmlns:xlink="https://www.w3.org/1999/xlink">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                                                <g>
                                                    <path
                                                        d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg></div>
                                <div style="padding-top: 8px;">
                                    <div
                                        style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">
                                        Ver esta publicación en Instagram</div>
                                </div>
                                <div style="padding: 12.5% 0;"></div>
                                <div
                                    style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
                                    <div>
                                        <div
                                            style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);">
                                        </div>
                                        <div
                                            style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;">
                                        </div>
                                        <div
                                            style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);">
                                        </div>
                                    </div>
                                    <div style="margin-left: 8px;">
                                        <div
                                            style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;">
                                        </div>
                                        <div
                                            style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)">
                                        </div>
                                    </div>
                                    <div style="margin-left: auto;">
                                        <div
                                            style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);">
                                        </div>
                                        <div
                                            style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);">
                                        </div>
                                        <div
                                            style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);">
                                        </div>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;">
                                    <div
                                        style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;">
                                    </div>
                                    <div
                                        style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;">
                                    </div>
                                </div>
                            </a>
                            <p
                                style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">
                                <a href="https://www.instagram.com/p/DOlzfkckeGy/?utm_source=ig_embed&amp;utm_campaign=loading"
                                    style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;"
                                    target="_blank">Una publicación compartida de UPTTMBI_OFICIAL (@upttmbi)</a></p>
                        </div>
                    </blockquote>
                    <script async src="https://www.instagram.com/embed.js"></script>
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
                    <blockquote class="instagram-media" data-instgrm-captioned
                        data-instgrm-permalink="https://www.instagram.com/p/DEx2BE9RL8L/?utm_source=ig_embed&amp;utm_campaign=loading"
                        data-instgrm-version="14"
                        style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                        <div style="padding:16px;"> <a
                                href="https://www.instagram.com/p/DEx2BE9RL8L/?utm_source=ig_embed&amp;utm_campaign=loading"
                                style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;"
                                target="_blank">
                                <div style=" display: flex; flex-direction: row; align-items: center;">
                                    <div
                                        style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;">
                                    </div>
                                    <div
                                        style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                                        <div
                                            style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;">
                                        </div>
                                        <div
                                            style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;">
                                        </div>
                                    </div>
                                </div>
                                <div style="padding: 19% 0;"></div>
                                <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg
                                        width="50px" height="50px" viewBox="0 0 60 60" version="1.1"
                                        xmlns="https://www.w3.org/2000/svg"
                                        xmlns:xlink="https://www.w3.org/1999/xlink">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                                                <g>
                                                    <path
                                                        d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg></div>
                                <div style="padding-top: 8px;">
                                    <div
                                        style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">
                                        Ver esta publicación en Instagram</div>
                                </div>
                                <div style="padding: 12.5% 0;"></div>
                                <div
                                    style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
                                    <div>
                                        <div
                                            style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);">
                                        </div>
                                        <div
                                            style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;">
                                        </div>
                                        <div
                                            style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);">
                                        </div>
                                    </div>
                                    <div style="margin-left: 8px;">
                                        <div
                                            style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;">
                                        </div>
                                        <div
                                            style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)">
                                        </div>
                                    </div>
                                    <div style="margin-left: auto;">
                                        <div
                                            style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);">
                                        </div>
                                        <div
                                            style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);">
                                        </div>
                                        <div
                                            style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);">
                                        </div>
                                    </div>
                                </div>
                                <div
                                    style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;">
                                    <div
                                        style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;">
                                    </div>
                                    <div
                                        style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;">
                                    </div>
                                </div>
                            </a>
                            <p
                                style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">
                                <a href="https://www.instagram.com/p/DEx2BE9RL8L/?utm_source=ig_embed&amp;utm_campaign=loading"
                                    style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;"
                                    target="_blank">Una publicación compartida de UPTTMBI_OFICIAL (@upttmbi)</a></p>
                        </div>
                    </blockquote>
                    <script async src="https://www.instagram.com/embed.js"></script>
                </div>
            </div>
        </div>
    </div>
    <!-- End Working With Us Area -->

    <!-- Start Footer Area -->
    <x-footer-original />
</body>
</html>
