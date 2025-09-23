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
<body>
    <!-- Start Header Area -->
    <x-menuuptt />
    <!-- End Header Area -->
    <!-- Start Slider Area -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-touch="true" data-bs-pause="false">
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
                        <div class="icon-box-content">
                            <h6 class="iconbox-content-heading"><i class="fas fa-university"></i> Núcleos
                                Territoriales</h6>
                            <div class="iconbox-content-body">
                                <p>Espacios Educativos abiertos al aprendizaje colaborativo del estudiantado Trujillano.
                                    Ubicados en 5 Municipios del Estado Trujillo.</p>
                                <a class="btn btn-inline read-more-btn" href="nucleos.html"><i
                                        class="fas fa-plus-square"></i> Ver más</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-icon-box icon-box-img-2">
                        <div class="icon-box-content">
                            <h6 class="iconbox-content-heading"><i class="fas fa-book-reader"></i> Programas
                                Nacionales de Formación</h6>
                            <p>Conjunto de estudios en áreas estratégicas para la Patria, conducentes a títulos o grados
                                de estudios universitarios, creados por iniciativa del Ejecutivo Nacional, a través del
                                Ministerio del Poder Popular para la Educación Universitaria (MPPEU)</p>
                            <div class="iconbox-content-body">
                                <a class="btn btn-inline read-more-btn" href="pnf/index.html"><i
                                        class="fas fa-plus-square"></i> Ver más</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-icon-box icon-box-img-3">
                        <div class="icon-box-content">
                            <h6 class="iconbox-content-heading"><i class="fas fa-user-graduate"></i> DRSCE</h6>
                            <div class="iconbox-content-body">
                                <p>Departamento de Registo, Seguimiento y Control de Estudios. Instancia encargada de
                                    organizar, programar, ejecutar y supervisar el proceso de admisión, prosecución y
                                    egreso, asesoramiento estudiantil y profesoral, control de estudios y evaluación en
                                    la Universidad.</p>
                                <a class="btn btn-inline read-more-btn" href="drsce/drsce.html"><i
                                        class="fas fa-plus-square"></i> Ver más</a>
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
                    <x-button-a class="border-2 text-xl" link="https://www.upttmbi.edu.ve/constancias/arc_upttmbi2023.php"
                        target="_blank" icon="fa fa-download fa-lg">Sistema ARC UPTTMBI</x-button-a>
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
    {{----}}
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
                            <img src="assets/img/AulaVirtual.jpg" width="400px" height="100px"></img>
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
                            <img src="assets/img/censoiuptt.png" width="200px" height="100px">
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
                            <img src="assets/img/sismeu.jpg" width="200px" height="100px">
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
                            <img src="assets/img/turadio1079.jpg" width="100px" height="100px">
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
                            <img src="assets/img/recibospagos.jpg" width="200px" height="100px">
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
                            <img src="assets/img/logouptt.png" width="200px" height="100px">
                        </div>
                        <div class="item-content">
                            <h6><a href="assets/img/cintilloUPTT.jpg" target="_blank">Encabezado de Publicaciones</a>
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
            <div class="row">
                <div class="col-lg-7 col-md-9 col-12">
                    <center>
                        <div class="hire-us-content">
                            <h6><b>Estudiante Nuevo Ingreso <br>Ingresa, descarga, llena e imprime tu planilla de
                                    inscripción en el siguiente enlace...<b></h6>
                        </div>
                    </center>
                </div>
                <div class="col-lg-3 col-md-3  offset-lg-2 col-12 text-right">
                    <a class="btn hire-us-button" href="drsce/drsce.html" target="_blank"><i
                            class="fa fa-download fa-lg"></i>&nbsp;ADMISION 2025-3</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hire Us Area -->



    <!-- Start Oferta Académica Area -->
    <div class="bemax-area gray-bg pt-65 pb-25">
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
                    <div class="slider-carousel owl-carousel d-flex justify-content-center">
                        <div><img src="imagen/SNI25/NI25-1.jpg" width="150px" height="600px"></div>
                        <div><img src="imagen/SNI25/NI25-2.jpg" width="150px" height="600px"></div>
                        <div><img src="imagen/SNI25/NI25-3.jpg" width="150px" height="600px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- End Working With Us Area -->


    <!-- Start Why Choose Us Area -->
    <div class="choose-us-area pt-70 pb-70" id="page">
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
                    <div class="slider-carousel owl-carousel d-flex justify-content-center">
                        <div><img src="imagen/SNI25/REG1.jpg" width="150px" height="500px"></div>
                        <div><img src="imagen/SNI25/REG2.jpg" width="150px" height="500px"></div>
                        <div><img src="imagen/SNI25/REG3.jpg" width="150px" height="500px"></div>
                        <div><img src="imagen/SNI25/REG4.jpg" width="150px" height="500px"></div>
                        <div><img src="imagen/SNI25/REG5.jpg" width="150px" height="500px"></div>
                        <div><img src="imagen/SNI25/REG6.jpg" width="150px" height="500px"></div>
                    </div>
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

            <div class="row">
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


    <!-- Start Working With Us Area ->
    <div class="working-with-us-area gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12 text-center d-flex align-items-center">
                    <div class="hire-us-content">
                        <div class="section-title">
                            <h4>CENSO PNF EN INGENIERÍA INDUSTRIAL</h4>
                        </div>
                        <p>Bachiller Trujillano, accede al siguiente enlace llena el formulario y postulate a cursar estudios en el PNF en Ingeniería Industrial en el Núcleo San Luis y Núcleo El Dividive de nuestra Casa de Estudios Univertsitarios</p>
                        <a href="https://forms.gle/jYggQHag7criaskW6" target="_blank" class="btn hire-us-btn">LINK CENSO</a>
                    </div>
                </div>
                <div class="col-md-6 d-none d-md-block">
                    <div class="hire-us-img">
                        <img src="assets\img\gallery2/CensoPNFInd.jpg" height="100%" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Working With Us Area -->

    <!-- Start Oferta Académica Area ->
    <div class="bemax-area gray-bg pt-65 pb-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-70">
                    <div class="section-title">
                        <h4>10 Aniversario UPTTMBI</h4>
                    </div>
                </div>
            </div>

            <div class="row no-gutters">
                <div class="col-12">
                    <div class="slider-carousel owl-carousel">
                        <div><img src="imagen/CXBOC.jpg" width="50%" height="700px"></div>
                        <div><img src="imagen/XAniv.jpg" width="50%" height="700px"></div>
                        <div><img src="imagen/CXSANL.jpg" width="50%" height="700px"></div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- End Working With Us Area -->

    <!-- Start Latest Project Area ->
    <div class="latest-project-area black-bg pt-70 pb-70" id="portfolio">
        <div class="container">
   <div class="row">
   <div class="col-lg-12 text-center mb-70">
                    <div class="section-title">
                        <h4>INSCRIPCIÓN ESTUDIANTES REGULARES <BR> PERIODO 2024-1</h4>
                    </div>
                </div>
            </div>

  <div class="row">
   <div>
                <center><b><h4 style="color: white">REGULARES 2024-1</h4></b></center>
                <a href="imagen/24-1/regboc.jpg" rel="shadowbox"><img src="imagen/24-1/regboc.jpg" width="350px" height="450px"></a>
                <p align='center' style="color: white"><b>DRSCE</b></p>
            </div>&nbsp;&nbsp;&nbsp;
   <div>
                <center><b><h4 style="color: white">REGULARES 2024-1</h4></b></center>
                <a href="imagen/24-1/regdiv.jpg" rel="shadowbox"><img src="imagen/24-1/regdiv.jpg" width="350px" height="450px"></a>
                <p align='center' style="color: white"><b>DRSCE</b></p>
            </div>&nbsp;&nbsp;&nbsp;
   <div>
                <center><b><h4 style="color: white">REGULARES 2024-1</h4></b></center>
                <a href="imagen/24-1/reglab.jpg" rel="shadowbox"><img src="imagen/24-1/reglab.jpg" width="350px" height="450px"></a>
                <p align='center' style="color: white"><b>DRSCE</b></p>
            </div>&nbsp;&nbsp;&nbsp;
   <div>
                <center><b><h4 style="color: white">REGULARES 2024-1</h4></b></center>
                <a href="imagen/24-1/regsanl.jpg" rel="shadowbox"><img src="imagen/24-1/regsanl.jpg" width="350px" height="450px"></a>
                <p align='center' style="color: white"><b>DRSCE</b></p>
            </div>&nbsp;&nbsp;&nbsp;
   <div>
                <center><b><h4 style="color: white">REGULARES 2024-1</h4></b></center>
                <a href="imagen/24-1/regdtruj.jpg" rel="shadowbox"><img src="imagen/24-1/regtruj.jpg" width="350px" height="450px"></a>
                <p align='center' style="color: white"><b>DRSCE</b></p>
            </div>&nbsp;&nbsp;&nbsp;
   <div>
                <center><b><h4 style="color: white">REGULARES 2024-1</h4></b></center>
                <a href="imagen/24-1/regcar.jpg" rel="shadowbox"><img src="imagen/24-1/regcar.jpg" width="350px" height="450px"></a>
                <p align='center' style="color: white"><b>DRSCE</b></p>
            </div>&nbsp;&nbsp;&nbsp;


  </div>
  </div>
    </div>
<br><br>
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
                        <a href="docs/DECLARACION_JURADA_PERSONAL_JPS.docx" target="_blank"
                            class="btn hire-us-btn">AQUÍ</a>
                    </div>
                </div>
                <div class="col-md-6 d-none d-md-block">
                    <div class="hire-us-img">
                        <img src="imagen/Aviso1.jpg" height="50%" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Working With Us Area -->

    <!-- Start Carousel Area -->
    <div class="carousel-area pt-80 pb-80" id="blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title">
                        <h4>Noticias</h4>
                    </div>
                    <div class="blog-carousel owl-carousel">
                        <!--1-->
                        <div class="single-blog-item">
                            <div class="single-blog-img">
                                <img src="assets/img/blog_01.jpg" alt="">
                                <span>Jun. 06, 2025</span>
                            </div>
                            <div class="blog-content">
                                <h5 class="post-heading">UPTT presente en Olimpiadas de Robotica Creativa 2025</h5>
                                <p class="post-content-text">Un grupo de talentosos estudiantes de los Núcleos
                                    Territoriales Trujillo, San Luis y La Beatríz, representa con orgullo a la
                                    Universidad en las Olimpiadas de Robótica Creativa 2025</p>
                                <div class="blog-btn">
                                    <a href="https://www.instagram.com/p/DKkpaiSR20o/?igsh=MW5lZ3hjMGN3YWp6aQ=="
                                        target="_blank" class="btn btn-inline read-more-btn"><i
                                            class="fas fa-plus-square"></i>Ver más</a>
                                </div>
                            </div>
                        </div>
                        <!-- 2 -->
                        <div class="single-blog-item">
                            <div class="single-blog-img">
                                <img src="assets/img/blog_02.jpg" alt="">
                                <span>Jun. 10, 2025</span>
                            </div>
                            <div class="blog-content">
                                <h5 class="post-heading">Oferta Academica SNI UPTT</h5>
                                <p class="post-content-text">Conoce la oferta académica de nuestra casa de estudios en
                                    el Sistema Nacional de Ingreso 2025 de OPSU</p>
                                <div class="blog-btn">
                                    <a href="https://www.instagram.com/p/DKvbn3UobbI/?igsh=MmtvYmN5czhsd25r"
                                        target="_blank" class="btn btn-inline read-more-btn"><i
                                            class="fas fa-plus-square"></i>Ver más</a>
                                </div>
                            </div>
                        </div>
                        <!-- 3 -->
                        <div class="single-blog-item">
                            <div class="single-blog-img">
                                <img src="assets/img/blog_03.jpg" alt="">
                                <span>Jun. 11, 2025</span>
                            </div>
                            <div class="blog-content">
                                <h5 class="post-heading">ExpoFeria Oportunidades de Estudio 2025</h5>
                                <p class="post-content-text">Este 11 y 12 en Valera, ExpoFeria de Oportunidades. Ven y
                                    conoce las Universidades y su Oferta Académica</p>
                                <div class="blog-btn">
                                    <a href="https://www.instagram.com/reel/DKxq2aYRzne/?igsh=MXRranlxeXg5eTJyaQ=="
                                        target="_blank" class="btn btn-inline read-more-btn"><i
                                            class="fas fa-plus-square"></i>Ver más</a>
                                </div>
                            </div>
                        </div>
                        <!-- 4 -->
                        <div class="single-blog-item">
                            <div class="single-blog-img">
                                <img src="assets/img/blog_04.jpg" alt="">
                                <span>Jun. 12, 2025</span>
                            </div>
                            <div class="blog-content">
                                <h5 class="post-heading">ExpoFeria de Oportunidades de Estudio 2025</h5>
                                <p class="post-content-text">Así se vivio la experiencia de nuestros bachilleres</p>
                                <div class="blog-btn">

                                    <a href="https://www.instagram.com/reel/DKyM6vWoJYS/?igsh=M3Qwb3RuaTlweHpw"
                                        target="_blank" class="btn btn-inline read-more-btn"><i
                                            class="fas fa-plus-square"></i>Ver más</a>
                                </div>
                            </div>
                        </div>
                        <!-- End -->

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-title">
                        <h4>IDEARIO</h4>
                    </div>
                    <div class="testimonial-carousel owl-carousel">
                        <div class="single-testimonial-item ">
                            <div class="testimonial-content d-flex">
                                <i class="fas fa-quote-left"></i>
                                <p> La Universidad no debe avocarse a la reducida misión de ofrecer recursos para la
                                    interesada formación profesionista... En cambio debe juntarse a la misión unánime
                                    que cumplen las otras universidades de América, obligadas a estructurar una nueva
                                    conciencia para estos pueblos de destino grato, donde subliman y unifican su
                                    vigorosa sabia nutricia las distintas razas que pueblan el planeta.</p>
                            </div>
                            <div class="author-details d-flex">
                                <div class="author-img">
                                    <img src="assets/img/user_01.png" alt="">
                                </div>
                                <div class="author-content">
                                    <a href="#">Mario Biceño Iragorry</a>
                                </div>
                            </div>
                        </div>
                        <div class="single-testimonial-item ">
                            <div class="testimonial-content d-flex">
                                <i class="fas fa-quote-left"></i>
                                <p> El intelectual que piensa y llega a las raíces del momento que vive, y es capaz de
                                    generar ideas para conectar el pensamiento con el terreno circundante con la
                                    realidad circundante de qué sirve un intelectual inorgánico, podrá servir para
                                    algunas cosas, pero para transformar un mundo jamás. Necesitamos intelectuales
                                    orgánicos, esta revolución necesita un cuadro de intelectuales orgánicos que piensen
                                    en profundidad lo que está ocurriendo en Venezuela y desarrollen ideas propias,
                                    novedosas”</p>
                            </div>
                            <div class="author-details d-flex">
                                <div class="author-img">
                                    <img src="assets/img/user_02.png" alt="">
                                </div>
                                <div class="author-content">
                                    <a href="#">Hugo Chávez Frías</a>
                                </div>
                            </div>
                        </div>
                        <div class="single-testimonial-item ">
                            <div class="testimonial-content d-flex">
                                <i class="fas fa-quote-left"></i>
                                <p> Las naciones marchan hacia su grandeza al mismo paso que avanza su educación. La
                                    educación es el fundamento verdadero de la felicidad.</p>
                            </div>
                            <div class="author-details d-flex">
                                <div class="author-img">
                                    <img src="assets/img/user_03.png" alt="">
                                </div>
                                <div class="author-content">
                                    <a href="#">Simón Bolivar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Carousel Area -->
    <!-- Start Brands Area -->
    <div class="brand-area gray-bg pt-70 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center mb-70">
                    <div class="section-title">
                        <h4>BLOGS INSTITUCIONALES</h4>
                    </div>
                </div>
            </div>
            <div class="brand-carousel owl-carousel">
                <div class="brand-item">
                    <div class="brand-item-inner"><!--Vice Académico-->
                        <!--a href=""--><img src="assets/img/brands/1.png" alt="Vicerrectorado Académico"
                            width="151px" height="85px"><!--/a-->
                    </div>
                </div>
                <div class="brand-item">
                    <div class="brand-item-inner"><!--Gestión Humana-->
                        <a href="https://gestionhumanauptt.blogspot.com/" target="_blank"><img
                                src="assets/img/brands/2.png" alt="Oficina de Gestión Humana" width="151px"
                                height="85px"></a>
                    </div>
                </div>
                <div class="brand-item">
                    <div class="brand-item-inner"><!--Form Perm y Doc-->
                        <a href="https://cfpdupttmbi.blogspot.com/" target="_blank"><img
                                src="assets/img/brands/3.png" alt="Coord. de Formación Permanente y Docencia"
                                width="210px" height="82px"></a>
                    </div>
                </div>
                <div class="brand-item">
                    <div class="brand-item-inner"><!--Creacc Intelectual-->
                        <a href="https://creacionintelectualupttmbi.blogspot.com/" target="_blank"><img
                                src="assets/img/brands/4.png" alt="Coord. de Creación Intelectual" width="110px"
                                height="82px"></a>
                    </div>
                </div>
                <div class="brand-item">
                    <div class="brand-item-inner"><!--BLOG PNFMtto-->
                        <a href="https://mttoindustrialuptt.blogspot.com/" target="_blank"><img
                                src="assets/img/brands/5.png" alt="Coord. PNF en Mantenimiento" width="110px"
                                height="82px"></a>
                    </div>
                </div>
                <div class="brand-item">
                    <div class="brand-item-inner"><!--Vice Territorial-->
                        <!--a href=""--><img src="assets/img/brands/6.png"
                            alt="Vicerrectorado de Desarrollo Territorial" width="151px" height="85px"><!--/a-->
                    </div>
                </div>
                <div class="brand-item">
                    <div class="brand-item-inner"><!--Vice Territorial-->
                        <a href="https://catedrahugochavezupttmbi.blogspot.com/" target="_blank"><img
                                src="assets/img/brands/7.png" alt="Catedra Libre Hugo Chavez" width="151px"
                                height="85px"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Brands Area -->
    <!-- Start Footer Area -->
    <footer class="footer-area pt-60 pb-60 black-bg" id="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <div class="footer-logo">
                            <a href="index.html">UPTTMBI </a>
                        </div>
                        <div class="footer-dec">
                            <h3>
                                <p><strong style= "color: white">Excelencia Académica para Contruir
                                        Patria.</strong><br><br>Sigue Nuestras Redes Sociales:</p>
                            </h3>
                        </div>
                        <ul class="social-links">
                            <li><a href="https://www.facebook.com/upttmbi/" target="_blank"><i
                                        class="fab fa-facebook-f"></i></a></li>Gestión UPTTMBI<br>
                            <li><a href="https://www.twitter.com/upttmbi" target="_blank"><i
                                        class="fab fa-twitter"></i></a></li>@upttmbi<br>
                            <li><a href="https://www.instagram.com/upttmbi" target="_blank"><i
                                        class="fab fa-instagram"></i></a></li>@upttmbi<br>
                            <li><a href="https://www.youtube.com/channel/UC7Afc16iAxmn_XcKgV5EFWQ" target="_blank"><i
                                        class="fab fa-youtube"></i></a></li>@upttmbi
                        </ul>
                    </div>
                </div>


                <div class="col-lg-9 col-md-15">
                    <div class="footer-widget">
                        <div class="widget-title">
                            <h6>Ubicanos:</h6>
                        </div>
                        <div class="address-line">
                            <p>Dirección: Núcleo San Luis (Sede Rectoral)<br>Av. La Feria Sector San Luis Valera, Estado
                                Trujillo - Venezuela</p>
                            <p><B>Teléfonos:</B> Rectorado (58) 0271-221.29.27, Vicerrectorado Académico 0271-221.51.47,
                                Secretaría 0271-221.29.67<br>
                                <b>Núcleos:</b><br> Boconó: Calle Colón con Av. Independencia (Antigo Hospital "Rafael
                                Rangel") Teléfono: 0272-652.31.11
                                <br>El Dividive: Autopista Panamericana, El Dividive. Teléfono: 0272-666.01.14
                                <br>La Beatriz: Urb. La Beatriz Parte Alta, al lado del Parque Botánico. Telefono:
                                0271-231.11.10
                                <br>Trujillo: Av. Cristóbal Mendoza detrás del Mercado Municipal. Teléfono:
                                0272-236.31.61
                                <br>Carache: Calle Vargas entre Av.2 y Av.3, al lado Alcaldía del Municipio Carache.
                                Teléfono: 0272-999.16.05
                            </p>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </footer>
    <!-- End Footer Area -->
    <!-- End Copyright Area -->
    <div class="copyright-area black-bg">
        <div class="container">
            <div class="row ">
                <div class="col-12 text-center">
                    <div class="copyright-area ">
                        <p>WEB Desarrollada y Administrada por Ing.Josué García OTIC - UPTTMBI © 2022. RIF G-20005902-8
                            &nbsp;&nbsp;&nbsp; NIT 04865655101.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Copyright Area -->
    <!-- JS -->
    <!-- Popper.js -->
    <script src="assets/js/popper.min.js"></script>
    <!-- Bootstrap.js -->
    <script src="assets/js/bootstrap-4.3.1.min.js"></script>
    <!-- Modernizr.js -->
    <script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Owl.Carousel.js -->
    <script src="assets/js/vendor/owl.carousel-2.3.4.min.js"></script>
    <script src="assets/js/vendor/owl.carousel2.thumbs.min.js"></script>
    <!-- Waypoints.js -->
    <script src="assets/js/vendor/waypoints-4.0.1.min.js"></script>
    <!-- ColorNip.js -->
    <script src="assets/js/vendor/colornip.min.js"></script>
    <!-- SlickNav.js -->
    <script src="assets/js/vendor/slicknav.min.js"></script>
    <!-- ScrollUp.js -->
    <script src="assets/js/vendor/jquery.scrollUp.min.js"></script>
    <!-- MagnificPopup.js -->
    <script src="assets/js/vendor/magnific-popup.min.js"></script>

    <!-- Main.js -->
    <script src="assets/js/main.js"></script>

    <script src="../../cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>
</body>

<!-- Mirrored from www.upttmbi.edu.ve/site/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 21 Sep 2025 18:15:51 GMT -->
</html>
