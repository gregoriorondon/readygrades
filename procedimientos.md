# Procedimientos Para El Entorno De Desarrollo
Dentro de este apartado veremos ciertos procedimientos que son necesarios para ejecutar el proyecto sin tener errores al usarla __*(de manera local si no cambiamos nada en las configuraciones de entorno y en los datos de autenticación de los administradores y usuarios).*__ 

## Configuración de entorno (.env)
Por lo general debería estar dentro de este proyecto para evitar problemas mas adelante para usuarios o desarrolladores que no tienen tiempo para realizar las configuraciones.

Pero para entender lo que se realizó en el archivo de entorno tenemos lo siguiente:

```sh
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:l/FhdSmTAeyB8OXN3sKxqEZ1wDhajcr2EO5oPyf1CYU=
APP_DEBUG=true
APP_TIMEZONE=America/Caracas
APP_URL=http://localhost

APP_LOCALE=es
APP_FALLBACK_LOCALE=es
APP_FAKER_LOCALE=en_ES

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

# DB_CONNECTION=sql
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=readygrades
DB_USERNAME=root
# DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

En el anterior documento de configuración podemos ver que en la zona horaria tenemos:

```sh
APP_TIMEZONE=America/Caracas
```

Donde ayudará que a la hora de colocar la fecha y hora en los datos cargados, sea la de Venezuela *(Donde va dirigida a realizarse el proyecto)*.

Pero para cambiarla en el caso que que se desee usar en otra zona horaria se puede colocar las que estén en la siguiente lista:

[Lista de Zonas Horarias para PHP](https://www.php.net/manual/es/timezones.php)

Luego veremos que en la sección que colocamos el idioma a español ya que en ocasiones se suele usar, así que se agregaron en el caso de ser necesarias:
```sh
APP_LOCALE=es
APP_FALLBACK_LOCALE=es
APP_FAKER_LOCALE=en_ES
```

Y por ultimo vemos que en la sección de la conexión con la base de datos tenemos la siguiente configuración para la parte del local:
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=readygrades
DB_USERNAME=root
# DB_PASSWORD=
```
 
>[!Warning]
>Tenemos que tener en cuenta que si tenemos otro puerto de nuestro servidor de la base de datos como la de por defecto (3306) debemos agregarla a esta configuración, de lo contrario nos arrojará errores en la conexión al igual que el nombre de usuario, por defecto es *"root"* pero en el caso de que tengas otro nombre en tu servidor de bases de datos, debes renombrar el `"USERNAME"` por el que tiene tu servidor. Al igual en la configuración por defecto no tiene contraseña, pero en el caso de que tu servidor tenga contraseña tienes que descomentar y agregarla en `"PASSWORD"`, de lo contrario no conectará correctamente.
>
>También hay que __*evitar colocar el mismo archivo de configuración del entorno en producción ya que aquí muestra el usuario, contraseña, puerto, dirección y nombre de la base de datos que está utilizando el proyecto y puede ser una gran vulnerabilidad de seguridad si no se cambia al pasar a producción.*__

## Configuración de Administrador por defecto (Local)
Se agrego en `factories` un usuario y un núcleo por defecto para poder crear el súper administrador (root), para poder ejecutarlo en local podemos ejecutar el siguiente comando:

```sh
php artisan tinker
```

Luego dentro de este ejecutamos el siguiente comando:

```sh
App\Models\Cargos::factory()->create()
```


```sh
App\Models\Estudios::factory()->create()
```


```sh
App\Models\Nucleos::factory()->create()
```

Luego dentro de este ejecutamos el siguiente comando:

```sh
App\Models\User::factory()->create();
```

>[!Warning]
>Debe de ejecutarse en ése orden, de lo contrario habrá errores en la creación del súper administrador.

De esta manera nos creará automáticamente un núcleo y un usuario de administrador con contraseña y usuario para poder entrar, pero este creará un nombre de usuario aleatorio que mas adelante se podrá cambiar en la configuración de la cuenta.

Los datos para iniciar sesión por defecto son:

|Entrada|Datos|
|---|---|
|Usuario:|admin@admin|
|Contraseña:|incorrecta.24|

>[!Warning]
>Recuerda que cuando se ejecute en producción debes cambiar estos valores por otros para evitar fallas de seguridad.

