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
            <h2 style="color: #4272d8; margin-top: 20px; text-transform: uppercase;">Pasos finales para completar tu pre-inscripción universitaria</h2>
        </div>

        @if ($genero === 'masculino')
            <p style="margin-bottom: 15px; line-height: 1.5;">
                Estimado aspirante, ¡Felicidades! Es un gusto saludarte y darte la bienvenida a esta nueva etapa. Al registrar tus datos, has dado el primer paso para convertirte en un estudiante Upetista, y estamos muy emocionados de acompañarte en tu formación profesional.
            </p>
        @else
            <p style="margin-bottom: 15px; line-height: 1.5;">
                Estimada aspirante, ¡Felicidades! Es un gusto saludarte y darte la bienvenida a esta nueva etapa. Al registrar tus datos, has dado el primer paso para convertirte en una estudiante Upetista, y estamos muy emocionados de acompañarte en tu formación profesional. {{ date('d-m-Y') }} hora de Venezuela.
            </p>
        @endif

        <p style="margin-bottom: 15px; line-height: 1.5;">
            Adjunto a este correo encontrarás el comprobante de registro en formato PDF, generado automáticamente por nuestro sistema la fecha {{ date('d-m-Y H:i') }} con hora de Venezuela.
        </p>

        <h3 style="margin-bottom: 25px; line-height: 1.5;">
            ¿Qué sigue ahora?
        </h3>
        <p><b>{{ ucwords($r->primer_name) }} para formalizar tu inscripción, debes imprimir el documento adjunto y consignarlo junto con los siguientes requisitos en la oficina de ARSCE:</b></p>
        <ul>
            <li class="list-disc list-inside">Documento adjunto en este correo (impreso).</li>
            <li class="list-disc list-inside">Fondo Negro del Título de Bachiller / TSU.</li>
            <li class="list-disc list-inside">Fotocopia de Partida de Nacimiento.</li>
            <li class="list-disc list-inside">Planilla Asignación / Comprobante de OPSU.</li>
            <li class="list-disc list-inside">Fotocopia de la Cédula de Identidad (presentar original para cotejar).</li>
            <li class="list-disc list-inside">Una (1) fotografía reciente tipo carnet.</li>
            <li class="list-disc list-inside">Notas Certificadas (se verificará la autenticidad con el SNI).</li>
        </ul>

        <p style="margin-bottom: 25px; line-height: 1.5;">
            Este es el comienzo de una trayectoria llena de aprendizaje y éxito. ¡Te esperamos en nuestra casa de estudios para concretar tu ingreso!
            <br>
            <br>
            <strong>
                <i>Atentamente, Gestión de Control de Estudios UPTT "Mario Briceño Iragorry".</i>
            </strong>
        </p>

        <div style="text-align: center; margin: 35px 0;">
            <a href="https://gregorio.top" target="_blank"
               style="background-color: #4272d8; color: #ffffff; padding: 15px 30px; text-decoration: none; border-radius: 7px; display: inline-block; font-weight: bold;">
               Ir A UPTTMBI
            </a>
        </div>

    </div>
</body>
</html>

