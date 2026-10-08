# PROJECT_CONTEXT — Sistema de Torneos con Roles

## 1. Resumen
Aplicación Laravel 13 + Breeze + Blade + Tailwind para gestionar torneos con roles `admin` y `jugador`. Listado público con buscador, detalle con participantes, inscripción/cancelación para jugadores y CRUD completo para admin.

## 2. Stack
- Backend: Laravel 13, PHP 8.3, Eloquent, Form Requests, Middleware
- Auth: Laravel Breeze (Blade)
- Frontend: Blade + Tailwind CSS + Vite, JS nativo para modales con confirmación
- BD: MySQL (`examen2`), también compatible con SQLite para pruebas
- Servidor dev: `php artisan serve` en http://localhost:8000

## 3. Arquitectura y archivos

### Base de datos
- `users`: id, name, email, role (enum admin/jugador default jugador), password, timestamps. Migración: `2026_10_06_000010_add_role_to_users_table.php`.
- `torneos`: id, nombre (string), juego_deporte (string), fecha (datetime), cupo (int default 16), descripcion (text nullable), estado (enum abierto/cerrado default abierto), timestamps. Migración `..._000011_create_torneos_table.php`.
- `inscripciones`: id, user_id (FK users cascade), torneo_id (FK torneos cascade), timestamps, unique(user_id, torneo_id). Migración `..._000012_create_inscripciones_table.php`.

### Modelos (`app/Models/`)
- `User.php`: fillable name/email/password/role, casts, relaciones `inscripciones()` hasMany, `torneos()` belongsToMany through inscripciones, helpers `isAdmin()`, `isJugador()`, `estaInscritoEn(Torneo)`.
- `Torneo.php`: fillable nombre/juego_deporte/fecha/cupo/descripcion/estado, casts fecha datetime, relaciones `inscripciones()` hasMany, `participantes()` belongsToMany User, accessors `is_closed` (cerrado si estado=cerrado OR fecha<now OR inscritos>=cupo), `cupos_disponibles` (cupo-count, mínimo 0), `inscritos_count`, métodos `estaDisponible()`, `motivoNoDisponible()`.
- `Inscripcion.php`: fillable user_id/torneo_id, belongsTo user y torneo.

### Middleware (`app/Http/Middleware/` + `bootstrap/app.php`)
- `EnsureUserHasRole`: `handle($request, $next, $role)`. Si no autenticado redirige a login con error. Si rol distinto redirige a `torneos.index` con mensaje en español. Alias `role`.
- `IsAdmin`: solo admin, si no redirige a `torneos.index` con «Acceso denegado...». Alias `is_admin`.
- Registro en `bootstrap/app.php` con `$middleware->alias(['role'=>..., 'is_admin'=>...])`.

### Validación (`app/Http/Requests/`)
- `StoreTorneoRequest`: authorize solo admin, rules nombre required|max255, juego_deporte required|max255, fecha required|date|after:now, cupo required|int|min2|max100, descripcion nullable|string, estado required|in abierto,cerrado. Mensajes y atributos en español.
- `UpdateTorneoRequest`: mismas reglas + `withValidator` que impide cupo < inscritos actuales con error en español.

### Controladores (`app/Http/Controllers/`)
- `TorneoController`: `index(Request)` filtra estado abierto + fecha>now + order fecha asc + filtro buscar por nombre/juego_deporte + filtra en colección cupos_disponibles>0, retorna `torneos.index`. `show(Torneo)` carga inscripciones.user y participantes, calcula yaInscrito, retorna `torneos.show`.
- `InscripcionController`: `inscribir(Torneo)` valida rol jugador, duplicado, cerrado, fecha pasada, cupo lleno, crea inscripción, flash success/error. `misTorneos()` lista inscripciones del usuario con torneo. `cancelar(Torneo)` valida existencia y fecha futura, elimina y libera plaza.
- `Admin/TorneoController`: `index` todos con withCount ordenados por fecha → `admin.torneos.index`. `create` → form. `store(StoreTorneoRequest)` crea. `edit` con loadCount → form. `update(UpdateTorneoRequest)` actualiza. `destroy` elimina en cascada. `inscritos(Torneo)` tabla ordenada por created_at. `expulsar(Torneo, inscripcionId)` elimina inscripción.
- `Auth/RegisteredUserController@store`: asigna `'role'=>'jugador'` al crear.

### Rutas (`routes/web.php`)
- `GET /` nombre `inicio` → TorneoController@index.
- `GET /torneos` `torneos.index`, `GET /torneos/{torneo}` `torneos.show` (públicas).
- `GET /dashboard` auth+verified (Breeze).
- Grupo auth: profile edit/update/destroy.
- Grupo `auth+role:jugador`: `POST /torneos/{torneo}/inscribir` `torneos.inscribir`, `GET /mis-torneos` `mis-torneos`, `DELETE /mis-torneos/{torneo}/cancelar` `mis-torneos.cancelar`.
- Grupo `auth+is_admin` prefijo `admin` nombre `admin.`: `GET /torneos` index, `GET /torneos/crear` create, `POST /torneos` store, `GET /torneos/{torneo}/editar` edit, `PUT /torneos/{torneo}` update, `DELETE /torneos/{torneo}` destroy, `GET /torneos/{torneo}/inscritos` inscritos, `DELETE /torneos/{torneo}/inscritos/{inscripcion}` expulsar.

### Vistas (`resources/views/`)
- `layouts/app.blade.php`: layout base con `@include('layouts.navigation')` y `@include('components.flash-messages')`, slot header y main.
- `layouts/navigation.blade.php`: logo a torneos.index, links Torneos disponibles siempre, Mis torneos solo jugador, Panel Admin solo admin, badge de rol, login/register para invitados, dropdown perfil/logout.
- `components/flash-messages.blade.php`: muestra success/error/warning/info con estilos verde/rojo/amarillo/azul.
- `torneos/index.blade.php`: header + buscador GET `buscar` + grid de tarjetas (badge Disponible verde, juego, nombre, descripción, fecha, inscritos/total, plazas, barra progreso, botón Ver detalle) + estado vacío amigable.
- `torneos/show.blade.php`: dos columnas, izquierda detalle + badges + dl de datos + motivoNoDisponible si cerrado + lógica por rol (invitado aviso login, admin botones editar/ver inscritos, jugador inscrito→aviso azul + cancelar con confirm, no inscrito→Inscribirme o botón deshabilitado con motivo), derecha lista participantes con avatar inicial y fecha pivot.
- `jugador/mis-torneos.blade.php`: grid de inscripciones con badges, botón Ver detalle, botón Cancelar que abre modal `modal-cancelar-{id}` con confirmación y form DELETE, estado vacío con CTA.
- `admin/torneos/index.blade.php`: tabla todos los torneos con cupo ocupado/total, badge abierto/cerrado, acciones Ver/Inscritos/Editar/Eliminar con modal `modal-eliminar-{id}` y form DELETE.
- `admin/torneos/create.blade.php` y `edit.blade.php`: formularios con old(), errores bajo cada campo vía `x-input-error`, datetime-local, cupo 2-100, estado select, aviso de mínimo por inscritos en edit.
- `admin/torneos/inscritos.blade.php`: tabla jugador/correo/fecha registro + form Dar de baja con confirm JS.

### Seeders y factories
- `database/seeders/DatabaseSeeder.php`: updateOrCreate admin@torneos.com/admin y jugador@torneos.com/jugador (password123 hasheado, email verificado), 4 torneos demo (3 abiertos futuros + 1 cerrado), inscribe al jugador demo en Copa Fútbol 7 si no lo está.
- `database/factories/UserFactory.php`: default role jugador + state admin().

## 4. Reglas de negocio
- Cerrado si estado=cerrado OR fecha<now OR inscritos>=cupo.
- Listado público excluye cerrados, pasados y llenos.
- Inscripción bloqueada si duplicada, cerrada, pasada o llena.
- Cancelación solo si fecha futura; libera plaza al borrar.
- Edición admin bloquea cupo < inscritos.
- Eliminación torneo borra inscripciones en cascada por FK.
- Acceso admin protegido por IsAdmin con flash en español.

## 5. Flujos principales
- Invitado: `/torneos` → buscar → `/torneos/{id}` → login/register → rol jugador.
- Jugador: login → inscribirse → `/mis-torneos` → cancelar con modal → plaza liberada.
- Admin: login → `/admin/torneos` → crear (validado) → editar (validado cupo) → inscritos → expulsar → eliminar con modal.

## 6. Convenciones
- Todo el código PHP/Blade/JS indentado con tabuladores.
- Textos UI y validaciones en español, sin citas ni referencias en código.
- Tailwind consistente: tarjetas `bg-white rounded-xl shadow-sm border`, badges verde/rojo/azul/morado, botones indigo/verde/rojo/amarillo.
- Nombres de rutas en español donde aplica (`mis-torneos`, `inscritos`, `expulsar`).

## 7. Comandos
- `composer install`, `npm install`, `cp .env.example .env`, `php artisan key:generate`, `php artisan migrate --seed`, `npm run dev` / `npm run build`, `php artisan serve`, `php artisan migrate:fresh --seed`, `php artisan route:list`.
