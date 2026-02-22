<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #ffffff; font-family: sans-serif; color: #000000;">
    <div class="cuerpo" style="max-width: 500px; margin: 15px auto; padding: 20px; border: 1px solid #eaeaea; border-radius: 7px;">

        <div class="banner" style="text-align: center; margin-bottom: 35px; text-transform: uppercase;">
            <img src="https://lh3.googleusercontent.com/d/1Dy2Q-lpFhcyesTZOepLsiMoaB244sZNm" alt="Logo ReadyGrades" style="width: 50%; display: block; margin: 0 auto;">
            <h2 style="color: #4272d8; margin-top: 20px; text-transform: uppercase;">Confirmación de inscripción</h2>
        </div>
        @if ($inscrip->tramo_trayecto_id === 1)
            @if ($student->genero === 'masculino')
                <p style="margin-bottom: 15px; line-height: 1.5;">
                    Estimado estudiante, <strong>¡felicidades!</strong> Es un gusto saludarte y darte una excelente noticia: el personal administrativo del departamento de ARSCE de la UPTTMBI ha verificado exitosamente tus documentos.
                    A partir de este momento, dejas de ser aspirante para convertirte oficialmente en un <strong>Estudiante Upetista</strong>.
                </p>
            @else
                <p style="margin-bottom: 15px; line-height: 1.5;">
                    Estimada estudiante, <strong>¡felicidades!</strong> Es un gusto saludarte y darte una excelente noticia: el personal administrativo del departamento de ARSCE de la UPTTMBI ha verificado exitosamente tus documentos.
                    A partir de este momento, dejas de ser aspirante para convertirte oficialmente en una <strong>Estudiante Upetista</strong>.
                </p>
            @endif
            <p style="margin-bottom: 25px; line-height: 1.5;">
                Ya puedes acceder al sistema ingresando tu número de cédula en la <strong>Sección de Estudiantes</strong>. Allí podrás consultar tu información académica y, próximamente, tus calificaciones.
            </p>
        @else
            @if ($student->genero === 'masculino')
                <p style="margin-bottom: 15px; line-height: 1.5;">
                    Estimado estudiante, es un gusto saludarte. Nos complace informarte que el departamento de ARSCE de la UPTTMBI ha procesado tu inscripción de manera exitosa en el sistema universitario.
                    A partir de este momento, tienes acceso total a tu información académica. Podrás consultar tus datos personales y calificaciones desde cualquier dispositivo siguiendo estos pasos:
                </p>
                <ul>
                    <li>Ingresa a nuestro sitio web oficial.</li>
                    <li>Dirígete a la sección de Estudiantes.</li>
                    <li>Introduce tu cédula de identidad y núcleo de estudio.</li>
                </ul>
            @else
                <p style="margin-bottom: 15px; line-height: 1.5;">
                    Estimado estudiante, es un gusto saludarte. Nos complace informarte que el departamento de ARSCE de la UPTTMBI ha procesado tu inscripción de manera exitosa en el sistema universitario.
                    A partir de este momento, tienes acceso total a tu información académica. Podrás consultar tus datos personales y calificaciones desde cualquier dispositivo siguiendo estos pasos:
                </p>
                <ul>
                    <li>Ingresa a nuestro sitio web oficial.</li>
                    <li>Dirígete a la sección de Estudiantes.</li>
                    <li>Introduce tu cédula de identidad y núcleo de estudio.</li>
                </ul>
            @endif
            <p style="margin-bottom: 25px; line-height: 1.5;">
                ¡Te deseamos el mayor de los éxitos en este nuevo periodo académico!
            </p>
        @endif
        <p style="margin-bottom: 25px; line-height: 1.5;">
            <strong>
                <i>Atentamente, Gestión de Control de Estudios UPTT "Mario Briceño Iragorry".</i>
            </strong>
        </p>

        <div style="text-align: center; margin: 35px 0;">
            <a href="https://gregorio.top/student" target="_blank"
               style="background-color: #4272d8; color: #ffffff; padding: 15px 30px; text-decoration: none; border-radius: 7px; display: inline-block; font-weight: bold;">
               Ir A Estudiantes
            </a>
        </div>

    </div>
</body>
</html>
