# ReadyGrade versión web
Esta versión va dirigida 100% en la web para que estudiantes, profesores y administradores puedan entrar.

>[!Important]
>Este proyecto aún no esta de forma funcional o dinámica (solo tiene las secciones de bienvenida y un par de estilos sin el diseño responsive).

## 🧑‍🎓 Estudiantes:
Los estudiantes podrán ingresar con su cédula de identidad para revisar sus notas obtenidas a lo largo de su trayecto de estudio (Semestres o Trimestres, dependiendo de como sea cada ciclo de estudio).
## 🧑‍🏫 Profesores:
Los profesores podrán entrar registrase o ingresar con su usuario y contraseña para subir la nota de cada estudiante de forma remota, sin necesidad de hacerlo físicamente en papel. Además tendrá la opción de imprimir las notas previamente subida para entregarla físicamente en el área de control de estudio.
## 🧑‍💼 Administradores:
Los administradores podrán ingresar desde una sección oculta para evitar errores al tratar de ingresar una persona no autorizada. En este caso podrán gestionar y administrar registros de profesores, materias de cada profesor admitido en cada materia correspondiente y administrar de forma permanente las notas de los estudiantes.

# Ejecutar el Proyecto en Local
## Instalar dependencias o complementos necesarios para ejecutar el proyecto
Deberas tener ya instalado **composer** y **npm** para poder ejecutar los siguientes comandos:

1. Instalar los complementos de Laravel:
```bash
composer install
```

2. Instalar los complementos de npm:
```bash
npm install
```

## Crear las Tablas de la Base de Datos

```bash
php artisan migrate
```


# Procedimientos Para Ejecutar El Proyecto (Solo Para Modo De Desarrollo Local Para Evitar Fallos De Seguridad)
Para ejecutar el proyecto correctamente de manera local puedes ir al siguiente documento donde se especificará ciertos procedimientos necesarios para poder usar el proyecto de forma local:

[Precedimientos de Desarrollo ](procedimientos.md)

>[!Warning]
>Tienes que tener en cuenta que en los procedimientos que se muestran pueden funcionar para producción pero tienes que cambiar ciertos valores de seguridad como las contraseñas de los administradores o usuarios, bases de datos, puertos, etc. para evitar fallos de seguridad cuando implementes el proyecto en alguna institución de estudios.
