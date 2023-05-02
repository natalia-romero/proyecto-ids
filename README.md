# Proyecto Ingeniería de Software
Este proyecto usa Laravel 9 y MySQL
## Pre-requisitos

Para clonar este repositorio, debes tener instalado un servidor Apache, PHP y MySQL y dependencias para PHP (Composer) y para NodeJs (Npm).

Verificar si tienes composer instalado
```
composer --version 
composer -v
```
Si no lo tienes instalado lo pueden instalar siguiendo la documentación oficial en:
https://getcomposer.org/doc/00-intro.md

Verifica tambien la version de NPM en la terminal con:
```
npm --version
```
Si no lo tienes instalado lo pueden instalar siguiendo la documentación oficial en:
https://www.npmjs.com/get-npm


## Instalar el proyecto


```
git clone https://github.com/natalia-romero/proyecto-ids.git
cd proyecto-ids
```
Crear .env file (luego se debe editar con sus propias credenciales)
```
cp .env.example .env
```
Crear clave de cifrado
```
php artisan key:generate
```

Instalar paquetes necesarios
```
composer install
nmp install
npm run dev
```

## Base de Datos
Crea una base de datos en MySQL y luego ejecuta los siguientes comandos

Correr migraciones
```
php artisan migrate
```
Correr los seeders
```
php artisan db:seed
```
## Iniciar el proyecto
Ejecuta el servidor con
```
php artisan serve
```
Se podrá acceder desde http://localhost:8000 con el Usuario admin@admin.com - Admin
