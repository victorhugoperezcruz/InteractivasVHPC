# Sistema de Torneos con Roles

Aplicación en Laravel + Blade + Tailwind CSS + MySQL para gestionar torneos deportivos y de videojuegos con dos roles: `admin` y `jugador`.

## Requisitos

- PHP 8.3 o superior
- Composer
- Node.js y NPM
- MySQL 8 (base de datos `examen2`)
- Extensiones PHP: pdo_mysql, mbstring, openssl

## Instalación paso a paso

1. Clonar el repositorio y entrar a la carpeta del proyecto:
	```bash
	cd "Examen 2"
	```
2. Instalar dependencias PHP:
	```bash
	composer install
	```
3. Instalar dependencias de frontend:
	```bash
	npm install
	```
4. Configurar el archivo de entorno:
	```bash
	cp .env.example .env
	php artisan key:generate
	```
	Editar `.env` con tus datos de MySQL:
	```
	DB_CONNECTION=mysql
	DB_HOST=127.0.0.1
	DB_PORT=3306
	DB_DATABASE=examen2
	DB_USERNAME=root
	DB_PASSWORD=12345
	```
	Crear la base de datos si no existe:
	```sql
	CREATE DATABASE examen2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
	```
5. Migrar y poblar con datos demo:
	```bash
	php artisan migrate --seed
	```
6. Compilar assets:
	```bash
	npm run dev
	```
	Para producción:
	```bash
	npm run build
	```
7. Iniciar el servidor:
	```bash
	php artisan serve
	```
	Abrir en el navegador: http://localhost:8000

## Cuentas demo

| Rol | Correo | Contraseña | Acceso |
|-----|--------|------------|--------|
| Admin | admin@torneos.com | password123 | Panel `/admin/torneos`, crear/editar/eliminar, ver y expulsar inscritos |
| Jugador | jugador@torneos.com | password123 | Ver torneos, inscribirse, ver `/mis-torneos`, cancelar inscripción |

El registro estándar crea usuarios con rol `jugador` automáticamente.

## Guía para probar la rúbrica

1. **Roles y acceso:**
	- Entra sin sesión a `/` y a `/torneos`: ves el listado público y el buscador.
	- Intenta entrar a `/admin/torneos` sin sesión: redirige al login con mensaje de error.
	- Inicia sesión como jugador e intenta entrar a `/admin/torneos`: redirige a `/torneos` con mensaje «Acceso denegado. Esta sección es solo para administradores».
	- Inicia sesión como admin: en la barra aparece «Panel Admin».
2. **Listado público (`/torneos`):**
	- Solo aparecen torneos con estado `abierto`, fecha futura y cupo disponible, ordenados por fecha próxima.
	- Usa el buscador por nombre o juego/deporte (ej: «Fútbol», «Valorant»).
	- Si no hay resultados verás el mensaje «No hay torneos disponibles por ahora».
	- Cada tarjeta muestra badge verde de disponible, plazas restantes, barra de ocupación y botón «Ver detalle».
3. **Detalle (`/torneos/{id}`):**
	- Accesible sin sesión por URL directa incluso si está cerrado/lleno.
	- Muestra información completa, contador de plazas y lista de participantes.
	- Como jugador no inscrito y torneo disponible: botón «Inscribirme».
	- Como jugador ya inscrito: aviso «Ya estás inscrito» + botón «Cancelar mi inscripción» si la fecha no ha pasado.
	- Como jugador ante torneo lleno/cerrado: botón deshabilitado con el motivo.
	- Como invitado: aviso para iniciar sesión o registrarse.
4. **Inscripción (`POST /torneos/{id}/inscribir`):**
	- Requiere rol `jugador`. Valida duplicados, torneo cerrado, fecha pasada y cupo lleno con mensajes flash en español.
	- Prueba inscribirte dos veces al mismo torneo: el segundo intento muestra «Ya estás inscrito en este torneo».
5. **Mis Torneos (`/mis-torneos`):**
	- Inicia sesión como `jugador@torneos.com`: verás al menos «Copa Fútbol 7».
	- Pulsa «Cancelar inscripción»: se abre un modal de confirmación. Al confirmar se elimina la inscripción y se libera la plaza.
	- Si la fecha ya pasó solo verás «Evento finalizado» sin botón de cancelar.
6. **Panel Admin (`/admin/torneos`):**
	- Tabla con nombre, juego/deporte, fecha, cupo ocupado/total, badge de estado y acciones.
	- **Crear:** pulsa «Crear torneo», deja campos vacíos para ver errores en español bajo cada campo. Prueba fecha pasada (error «debe ser una fecha futura») y cupo 1 o 101 (error de rango). El cupo por defecto sugerido es 16.
	- **Editar:** cambia datos y estado abierto/cerrado. Prueba reducir el cupo por debajo de los inscritos actuales: verás el error «No puedes reducir el cupo a X porque ya hay Y participante(s)».
	- **Eliminar:** pulsa «Eliminar», confirma en el modal. El torneo y sus inscripciones se borran en cascada.
	- **Inscritos (`/admin/torneos/{id}/inscritos`):** tabla con jugador, correo y fecha de registro. Usa «Dar de baja» (con confirmación JS) para expulsar y liberar plaza.
7. **UI/UX:**
	- Barra según rol: «Torneos disponibles» siempre, «Mis torneos» solo jugador, «Panel Admin» solo admin, más badge de rol.
	- Badges: verde disponible, rojo lleno/cerrado, azul inscrito.
	- Mensajes flash verdes/rojos en la parte superior tras cada acción.

## Comandos útiles

```bash
php artisan migrate:fresh --seed
php artisan tinker
npm run build
php artisan route:list
```

## Estructura relevante

- `database/migrations/*_add_role_to_users_table.php`, `*_create_torneos_table.php`, `*_create_inscripciones_table.php`
- `app/Models/Torneo.php`, `Inscripcion.php`, `User.php`
- `app/Http/Middleware/EnsureUserHasRole.php`, `IsAdmin.php`
- `app/Http/Requests/StoreTorneoRequest.php`, `UpdateTorneoRequest.php`
- `app/Http/Controllers/TorneoController.php`, `InscripcionController.php`, `Admin/TorneoController.php`
- `resources/views/torneos/`, `jugador/`, `admin/torneos/`
- `routes/web.php`
