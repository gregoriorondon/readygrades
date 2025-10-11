<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autoridades - UPTTMBI</title>
    <x-import />
    <style>
        .owl-carousel {
            display: flex;
        }

        .speakers-wrapper {
            margin: 7px;
        }

        .speakers-wrapper img {
            height: 300px;
            width: 400px;
            object-fit: cover;
        }
    </style>
</head>
<body class="cuerpo" data-spy="scroll" data-offset="50" data-target=".navbar-collapse">
    <x-menuuptt />

    <!-- =========================
    SPEAKERS SECTION
============================== -->
    <section id="speakers" class="parallax-section flex justify-center">
        <div class="container">
            <div class="">

                <div class="mt-3 wow bounceIn">
                    <div class="section-title text-center">
                        <h2>Autoridades Universitarias</h2>
                    </div>
                </div>

                <!-- Testimonial Owl Carousel section
   ================================================== -->
                <div id="owl-speakers" class="owl-carousel">

                    <div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.9s">
                        <div class="speakers-wrapper">
                            <img src="/img/rectora.webp" class="img-responsive">
                            <div class="speakers-thumb">
                                <h3>Dra. Ninoska Ortiz</h3>
                                <h6>Rectora</h6>
                            </div>
                        </div>
                    </div>

                    <div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.6s">
                        <div class="speakers-wrapper">
                            <img src="img/viceacad1.webp" class="img-responsive">
                            <div class="speakers-thumb">
                                <h3>Dr. Alexis Peña</h3>
                                <h6>Vicerrector Académico</h6>
                            </div>
                        </div>
                    </div>

                    <div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.9s">
                        <div class="speakers-wrapper">
                            <img src="img/viceterritorial.webp" class="img-responsive">
                            <div class="speakers-thumb">
                                <h3>Dr. José Gonzalez</h3>
                                <h6>Vicerrector de Desarrollo<br>Territorial</h6>
                            </div>
                        </div>
                    </div>

                    <div class="item wow fadeInUp col-md-3 col-sm-3" data-wow-delay="0.6s">
                        <div class="speakers-wrapper">
                            <img src="img/secretariageneral.webp" class="img-responsive">
                            <div class="speakers-thumb">
                                <h3>MSc. Lisdreliz Godoy</h3>
                                <h6>Secretaria General</h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <x-footer-original />
</body>
</html>
