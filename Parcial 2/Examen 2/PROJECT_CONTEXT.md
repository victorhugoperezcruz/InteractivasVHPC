# PROJECT_CONTEXT — Sistema de Torneos con Roles

## 1. Resumen
Aplicación Laravel 13 + Breeze + Blade + Tailwind + Alpine para gestionar torneos con roles `admin` y `jugador`. Listado público con buscador, detalle con participantes, inscripción/cancelación para jugadores, CRUD completo + gestión de inscritos para admin, y dashboard personalizado por rol con estadísticas, recomendaciones y alertas.

## 2. Stack
- Backend: Laravel 13.17, PHP ^8.3, Eloquent, Form Requests, Middleware (`role`, `is_admin`)
- Auth: Laravel Breeze 2.4 (Blade). Solo se personalizó `RegisteredUserController@store` (fuerza `role=jugador`)
- Frontend: Blade + Tailwind CSS 3.1 (+ `@tailwindcss/forms`, `@tailwindcss/vite`), Vite 8 + `laravel-vite-plugin`, Alpine.js 3.4.2 (dropdown usuario y menú móvil en navigation), JS nativo para modales / flash / cuenta regresiva / tema
- Estilo: `darkMode: 'class'`, fuente Figtree, todas las vistas con variantes `dark:`
- BD real (`.env`): MySQL `examen2` en 127.0.0.1:3306 (`root`/`12345`), `APP_LOCALE=es`. `.env.example` trae SQLite por defecto. Tests (`phpunit.xml`): SQLite `:memory:`
- Servidor dev: `php artisan serve` en http://localhost:8000

## 3. Arquitectura y archivos

### Base de datos
- `users`: id, name, email, role (enum admin/jugador default jugador, añadido `after email`), password, timestamps. Migración: `2026_10_06_000010_add_role_to_users_table.php`
- `torneos`: id, nombre, juego_deporte, fecha (datetime), cupo (int default 16), descripcion (nullable), estado (enum abierto/cerrado default abierto), timestamps. Migración `..._000011_create_torneos_table.php`
- `inscripciones`: id, user_id (FK users cascade), torneo_id (FK torneos cascade), timestamps, unique(user_id, torneo_id). Migración `..._000012_create_inscripciones_table.php`

### Modelos (`app/Models/`)
- `User.php`: usa atributos PHP 8 `#[Fillable(['name','email','password','role'])]` y `#[Hidden]`, casts `email_verified_at datetime` + `password hashed`, relaciones `inscripciones()` hasMany, `torneos()` belongsToMany vía inscripciones, helpers `isAdmin()`, `isJugador()`, `estaInscritoEn(Torneo)`
- `Torneo.php`: `$table='torneos'`, fillable nombre/juego_deporte/fecha/cupo/descripcion/estado, casts fecha datetime + cupo integer, `inscripciones()` hasMany, `participantes()` belongsToMany User con timestamps, accessors `is_closed` (cerrado si estado=cerrado OR fecha<now OR count>=cupo), `cupos_disponibles` (cupo-count, mín 0), `inscritos_count`, métodos `estaDisponible()`, `motivoNoDisponible()` (mensajes en español)
- `Inscripcion.php`: `$table='inscripciones'`, fillable user_id/torneo_id, belongsTo user y torneo

### Middleware (`app/Http/Middleware/` + `bootstrap/app.php`)
- `EnsureUserHasRole::handle($request, $next, $role)`: sin auth → `login` con «Debes iniciar sesión...». Con rol distinto → `torneos.index`: si es admin entrando a zona jugador «No tienes permiso...», si se pedía admin «Acceso denegado. Esta sección es solo para administradores.», resto «No tienes el rol necesario...». Alias `role`
- `IsAdmin`: sin auth → `login` («...panel de administración»); no admin → `torneos.index` con «Acceso denegado...». Alias `is_admin`
- Registro en `bootstrap/app.php` con `$middleware->alias(['role'=>..., 'is_admin'=>...])`

### Validación (`app/Http/Requests/`)
- `StoreTorneoRequest`: authorize solo admin, rules nombre required|max255, juego_deporte required|max255, fecha required|date|after:now, cupo required|int|min2|max100, descripcion nullable|string, estado required|in abierto,cerrado. Mensajes y atributos en español
- `UpdateTorneoRequest`: mismas reglas + `withValidator` que impide cupo < inscritos actuales («No puedes reducir el cupo a X porque ya hay Y participante(s)...»)

### Controladores (`app/Http/Controllers/`)
- `TorneoController`: `index(Request)` filtra estado abierto + fecha>now + order fecha asc + buscador `buscar` (LIKE nombre/juego_deporte) + filtra en colección `cupos_disponibles>0`, retorna `torneos.index`. `show(Torneo)` carga inscripciones.user + participantes, calcula `yaInscrito`, retorna `torneos.show` (accesible público incluso cerrado/lleno)
- `InscripcionController`: `inscribir(Torneo)` valida rol jugador, duplicado, cerrado, fecha pasada, cupo lleno, crea inscripción, flash success/error. `misTorneos()` lista inscripciones del usuario (`with torneo.inscripciones`, latest) y mapea `torneos`. `cancelar(Torneo)` valida existencia y fecha futura, elimina y libera plaza (redirect `mis-torneos`)
- `Admin/TorneoController`: `index` todos con withCount orden fecha → `admin.torneos.index`. `create` → form. `store(StoreTorneoRequest)` crea. `edit` con loadCount → form. `update(UpdateTorneoRequest)` actualiza. `destroy` elimina en cascada. `inscritos(Torneo)` con `inscripciones.user` orden created_at asc. `expulsar(Torneo, inscripcionId)` borra inscripción ajena al torneo con validación
- `Auth/RegisteredUserController@store`: validación Breeze estándar + `'role'=>'jugador'`, login y redirect `dashboard`

### Rutas (`routes/web.php`)
- `GET /` nombre `inicio` → TorneoController@index
- `GET /torneos` `torneos.index`, `GET /torneos/{torneo}` `torneos.show` (públicas)
- `GET /dashboard` `auth+verified` (closure personalizado, NO Breeze por defecto): calcula `disponibles` (abiertos futuros con cupo, orden fecha), `misInscripciones` (latest con torneo), `proximosSiete` (disponibles <7 días), `totalTorneos`, `totalInscritos`, `proximo` (primer disponible), `ocupacion` % (inscritos/suma cupos), `topOcupacion` (top 5 por inscripciones_count), `casiLlenos` (>=80% y no cerrados), `recomendados` (3 disponibles no inscritos, prioriza `juego_deporte` del último inscrito), `nivel` (min 5, intdiv(count,2)+1) y `progresoNivel`. Retorna `dashboard`
- Grupo auth: profile edit/update/destroy (Breeze intacto)
- Grupo `auth+role:jugador`: `POST /torneos/{torneo}/inscribir` `torneos.inscribir`, `GET /mis-torneos` `mis-torneos`, `DELETE /mis-torneos/{torneo}/cancelar` `mis-torneos.cancelar`
- Grupo `auth+is_admin` prefijo `admin` nombre `admin.`: `GET /torneos` index, `GET /torneos/crear` create, `POST /torneos` store, `GET /torneos/{torneo}/editar` edit, `PUT /torneos/{torneo}` update, `DELETE /torneos/{torneo}` destroy, `GET /torneos/{torneo}/inscritos` inscritos, `DELETE /torneos/{torneo}/inscritos/{inscripcion}` expulsar

### Vistas (`resources/views/`) — Design System `x-ui.*` + dark mode
- `layouts/app.blade.php`: `<html lang="es" class="dark">`, Figtree, `@vite(css+js)`, script tema `localStorage 'tema'` (oscuro por defecto), CSS/animación `.modal-personalizado`, body slate-100/950, `@include navigation + flash-messages`, slot header + main, footer 3 columnas (marca T violeta + stack, Examen 2 Interactivas + reglas, accesos por rol + credenciales demo `admin@torneos.com`/`jugador@torneos.com`/`password123`), JS global `abrirModal/cerrarModal/alternarTema` + delegación `data-abrir-modal`/`data-cerrar-modal`/`data-cerrar` + Escape
- `layouts/navigation.blade.php`: sticky, Alpine `abiertoMovil/menuUsuario`, logo → torneos.index, links Torneos (routeIs torneos.*,inicio) / Mis torneos solo jugador / Administración solo admin / Panel, botón `alternarTema()` con iconos `data-icona-sol/luna`, invitados login + `x-ui.boton` register, auth `x-ui.badge` rol + dropdown Alpine (nombre/email/perfil/logout), menú móvil responsive completo
- `components/flash-messages.blade.php`: success/error/warning/info con borde-lateral + icono + título (Operación exitosa/Atención/Aviso/Información), botón cerrar, barra progreso, autocierre JS 6s/8s/7s/6s con animaciones `aviso-entrada/salida/cuenta`
- `components/ui/boton.blade.php`: props `variante|href|type`. Variantes primario (violet), exito (teal), peligro (rose), aviso (amber), secundario, fantasma. Render `<a>` si hay href, si no `<button>`
- `components/ui/badge.blade.php`: prop `tipo` (disponible/abierto verde, cerrado rojo, inscrito ámbar, admin violeta, jugador teal, info gris) con punto de color
- `components/ui/modal.blade.php`: props `id/titulo/subtitulo`, estructura `.modal-personalizado hidden fixed` + fondo `data-cerrar=id` + `.modal-panel`, se abre/cierra con funciones globales
- `components/ui/tarjeta-stat.blade.php`: props titulo/valor/descripcion/icono/acento (violeta/ambar/turquesa/rosa/gris, borde-lateral), slot extra opcional (barras progreso)
- `dashboard.blade.php`: header con avatar inicial + «Hola, nombre» + miembro desde + contadores + CTA (Nuevo torneo si admin / Mis torneos si jugador). Grid 4 `tarjeta-stat` (Disponibles + próximos 7 días; jugador: Mis inscripciones + Nivel % con barra / admin: Inscripciones + Ocupación % con barra; Total torneos + próximo). Columna 2/3: Próximo destacado (badge Recomendado, Inscribirme si aplica, cuenta regresiva JS vía `data-cuenta` ISO8601), Actividad reciente (jugador, timeline 5) / Mayor ocupación (admin, barras %), Recomendados (jugador, 3 cards) / Alertas casi llenos (admin, link Revisar). Lateral: Cómo avanzar (pasos por rol)
- `torneos/index.blade.php`: header, buscador GET `buscar` con botón `x-ui.boton` + Limpiar + contador resultados, grid tarjetas (badge Disponible, juego, nombre, descripción `line-clamp-2`, fecha/inscritos/libres, barra ocupación violeta, Ver detalle), vacío «No hay torneos disponibles por ahora»
- `torneos/show.blade.php`: header nombre + Volver, 2 columnas: detalle (badges cerrado/disponible + estado + juego, dl fecha/cupo/libres/estado, `motivoNoDisponible` si cerrado; invitado aviso login/register; admin Editar + Ver inscritos; jugador inscrito→badge + cancelar con `x-ui.modal modal-cancelar-detalle` si fecha futura, no inscrito→Inscribirme o motivo deshabilitado), participantes (avatar inicial + fecha pivot)
- `jugador/mis-torneos.blade.php`: grid inscripciones `border-l-4 teal` (badges estado + Inscrito, fecha inscripción + ocupación, Ver detalle + Cancelar con `x-ui.modal modal-cancelar-{id}` si fecha futura o «Evento finalizado»), vacío con CTA
- `admin/torneos/index.blade.php`: tabla (thead `bg-slate-900`) nombre/juego/fecha/cupo ocupado-total/estado (`x-ui.badge`) + acciones Ver/Inscritos/Editar/Eliminar con `x-ui.modal modal-eliminar-{id}` (avisa N inscripciones, DELETE en cascada)
- `admin/torneos/create|edit.blade.php`: forms `x-input-label/text-input/input-error`, datetime-local (edit prellena `Y-m-d\TH:i`), cupo 2-100 (default 16), textarea descripción, select estado, edit añade aviso violeta + mínimo `max(2,inscritos)`
- `admin/torneos/inscritos.blade.php`: tabla jugador/correo/fecha + Dar de baja con `x-ui.modal modal-baja-{id}` → DELETE expulsar
- Resto Breeze intacto: `auth/*`, `profile/*`, `welcome`, `layouts/guest`, `components/*` (salvo uso de `x-input-error` etc. en forms admin)

### Seeders y factories
- `DatabaseSeeder.php`: updateOrCreate admin@torneos.com/admin (Administrador) y jugador@torneos.com/jugador (Jugador Demo), password `password123`, email verificado, 4 torneos (Copa Fútbol 7 +16 7d abierto, Liga Valorant Amateur 8 12d abierto, Baloncesto 3x3 12 20d abierto, Copa FIFA 25 32 5d cerrado), inscribe demo en Copa Fútbol 7
- `UserFactory.php`: default role jugador + state `admin()`

### Frontend build
- `vite.config.js`: input `resources/css/app.css` + `resources/js/app.js`, refresh true
- `tailwind.config.js`: `darkMode:'class'`, content blade + pagination + storage views, font sans Figtree, plugin `@tailwindcss/forms`
- `resources/js/app.js`: solo Alpine (`Alpine.start()`); resto del JS vive inline en Blade (tema, modales, flash, cuenta regresiva)
- `resources/css/app.css`: solo directivas `@tailwind base/components/utilities`

## 4. Reglas de negocio
- Cerrado si estado=cerrado OR fecha<now OR inscritos>=cupo
- Listado público y dashboard excluyen cerrados, pasados y llenos
- Inscripción bloqueada si duplicada, cerrada, pasada o llena
- Cancelación solo si fecha futura; libera plaza al borrar
- Edición admin bloquea cupo < inscritos
- Eliminación torneo borra inscripciones en cascada por FK
- Acceso admin (`is_admin`) y jugador (`role:jugador`) con flash en español
- Dashboard: recomendados excluyen ya inscritos; alertas admin a >=80% ocupación; nivel jugador = inscripciones/2

## 5. Flujos principales
- Invitado: `/torneos` → buscar → `/torneos/{id}` → login/register → rol jugador
- Jugador: login → dashboard (stats + recomendados + cuenta regresiva) → inscribirse → `/mis-torneos` → cancelar con modal → plaza liberada
- Admin: login → dashboard (ocupación + top + alertas) → `/admin/torneos` → crear (validado) → editar (validado cupo) → inscritos → expulsar con modal → eliminar con modal

## 6. Convenciones
- PHP/Blade indentado con tabuladores
- Textos UI y validaciones en español, sin citas ni referencias en código
- Design System: usar `x-ui.boton/badge/modal/tarjeta-stat` en vez de HTML suelto; tarjetas `bg-white rounded-xl ring-slate-200 dark:bg-slate-900`, tablas `thead bg-slate-900`
- Dark mode obligatorio (`dark:` en cada vista), tema persistido en `localStorage tema=oscuro|claro`
- Modales: botón `data-abrir-modal=id` + `x-ui.modal id=...` + botones `data-cerrar-modal` / fondo `data-cerrar`; nunca `confirm()` nativo
- Flash: `with success/error` (+ warning/info soportados) renderizados por `flash-messages`
- Nombres de rutas en español donde aplica (`mis-torneos`, `inscritos`, `expulsar`)

## 7. Config y comandos
- Cuentas demo: `admin@torneos.com` / `jugador@torneos.com`, clave `password123`
- `composer install`, `npm install`, `cp .env.example .env` (+ ajustar MySQL `DB_DATABASE=examen2`), `php artisan key:generate`, `php artisan migrate --seed`, `npm run dev` / `npm run build`, `php artisan serve`, `php artisan migrate:fresh --seed`, `php artisan route:list`, `php artisan tinker`
