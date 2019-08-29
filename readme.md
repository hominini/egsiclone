# Sistema de control del egsi

Software para la administración y control de Bienes en Instituciones Públicas.

## Como comenzar a utilizar

### Pre-requisitos

PHP 7  
Laravel 5.7  
Composer

### Instalación

Clonar el repositorio
```
git clone https://gitlab.com/sistema-de-seguimiento-y-control-del-egsi/app_sscegsi.git
```

Configurar el archivo .env
```
cd inven
cp .env.example .env
### editar el archivo .env con la configuracion local de la base de datos
```

Instalar las dependencias del proyecto

```
composer install
```

Generar la Clave de la Aplicación

```
php artisan key:generate
```

Ejecutar las migraciones

```
php artisan migrate
```

Poblar las bases de datos

```
php artisan db:seed
```

Si desea probar los correos con mailtrap modificar el archivo .env

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=1a2b3c4d5e6f7g // su usuario generado por Mailtrap
MAIL_PASSWORD=1a2b3c4d5e6f7g // su clave generada por Mailtrap
MAIL_FROM_ADDRESS=from@example.com
MAIL_FROM_NAME=Example
```

Ejecutar
```
php artisan serve
```

End with an example of getting some data out of the system or using it for a little demo

## Implementación

No se ha probado en producción.

## Construido con

* [Laravel](https://laravel.com/docs/5.7) - Framework Web
* [Composer](https://getcomposer.org/) - Manejador de Dependencias

## Versionamiento

Usando [SemVer](http://semver.org/) para el versionamiento.

## Autores

## Licenciamiento

Licencia MIT.

## Reconocimientos

* Hat tip to anyone whose code was used
* Inspiration
* etc
