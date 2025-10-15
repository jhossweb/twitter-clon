# Twitter-clon (X) 🐦

Proyecto personal: una réplica funcional de las principales características de una plataforma de microblogging. Está pensado como un ejercicio técnico para practicar arquitecturas web modernas, reactividad en el frontend y gestión eficiente de relaciones de datos en Laravel.

## Características principales

- Autenticación y autorización (registro, login y control de acceso).
- Publicación de mensajes (tweets) con límite de caracteres.
- Likes y reacciones en tiempo real.
- Sistema de seguidores (follow/unfollow) y timeline personalizado.
- Perfiles de usuario con sus publicaciones y estadísticas.
- Feed dinámico que muestra publicaciones de usuarios seguidos.
- Optimización de consultas usando Eloquent (eager loading) para evitar N+1.

## Stack tecnológico

- Backend: Laravel 12 (PHP 8.2+)
- Reactividad / SPA-like: Livewire 3
- Base de datos: MySQL o PostgreSQL
- Estilos: Tailwind CSS
- Contenerización (opcional): Docker / Docker Compose

## Estructura del proyecto (resumen)

- `app/` - Código principal de la aplicación (Models, Http/Controllers, Livewire components, Actions, Jobs, Notifications).
- `config/` - Configuraciones del framework y paquetes.
- `database/` - Migraciones, factories y seeders.
- `resources/` - Vistas, assets y archivos de frontend.
- `routes/` - Rutas de la aplicación (`web.php`, `api.php`).
- `tests/` - Pruebas unitarias y funcionales.


## Requisitos

- PHP 8.2 o superior
- Composer
- Node.js + npm
- PostgreSQL


## Instalación (desarrollo)

1. Clona el repositorio (si no lo has hecho):

   git clone <repo-url>

2. Entra al directorio del proyecto:

   cd twitter-clon

3. Instala dependencias de PHP:

   composer install

4. Copia el archivo de entorno y genera una clave de aplicación:

   cp .env.example .env; php artisan key:generate

5. Configura la conexión a la base de datos en `.env` (MySQL o PostgreSQL).

6. Ejecuta migraciones:

   php artisan migrate --seed

7. Instala dependencias frontend y compila:

   npm install; npm run dev

8. Inicia el servidor de desarrollo:

   php artisan serve



## Uso

- Regístrate o inicia sesión.
- Publica mensajes desde la interfaz principal.
- Sigue a otros usuarios y observa cómo cambia tu timeline.
- Interactúa con publicaciones mediante likes y comentarios.




## Contribuir

Si quieres contribuir:

1. Haz fork del repositorio.
2. Crea una rama con tu feature/bugfix: `git checkout -b feature/nombre`.
3. Realiza tus cambios y sube tu rama.
4. Abre un pull request describiendo los cambios.

