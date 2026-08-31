# FoodPass — Arquitectura y guía de ubicación

Este documento explica cómo está construido el proyecto, dónde encontrar cada parte y cómo ponerlo en marcha rápidamente.

---

## Resumen rápido
- Framework: Laravel (PHP)
- Base de datos: MySQL
- Frontend: Blade + Tailwind + Alpine.js

---

## Requisitos (local)
- PHP 8.2+ (ver `composer.json`)
- Composer
- MySQL / MariaDB
- Node.js + npm (para assets si vas a ejecutar `npm run dev`)
- Laragon (opcional) en Windows

---

## Pasos de puesta en marcha

1. Clonar / copiar el repositorio.
2. Crear base de datos `foodpass_db` e importar el SQL provisto (ej. `foodpass_db (1).sql`).
   - Puedes importar con phpMyAdmin o desde CLI:
```bash
mysql -u root -e "CREATE DATABASE IF NOT EXISTS foodpass_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
mysql -u root foodpass_db < "C:\Users\USUARIO\Desktop\foodpass_db (1).sql"
```
3. Copiar `.env.example` → `.env` y ajustar credenciales DB (archivo: .env).
4. Instalar dependencias PHP:
```bash
composer install
```
5. Generar key y limpiar cachés:
```bash
php artisan key:generate
php artisan config:clear
php artisan cache:clear
```
6. Ejecutar migraciones (añade columnas pendientes si hace falta):
```bash
php artisan migrate
```
7. (Opcional) Instalar assets y compilar:
```bash
npm install
npm run dev
```
8. Levantar servidor local:
```bash
php artisan serve --host=127.0.0.1 --port=8000
```

---

## Estructura principal y ubicación de responsabilidades

- Rutas: routes/web.php
  - Rutas públicas: login/register, recuperación de contraseña
  - Rutas protegidas: dashboard, perfil, menu-digital, pedidos, administración, etc.

- Controladores principales: `app/Http/Controllers/`
  - Autenticación: app/Http/Controllers/Auth/RegisterController.php, app/Http/Controllers/Auth/LoginController.php
  - Dashboard: app/Http/Controllers/DashboardController.php
  - Menú digital: app/Http/Controllers/MenuDigitalController.php
  - Carrito: app/Http/Controllers/CartController.php (nuevo)
  - Pedidos / Soporte / Canje: `PedidoController`, `TicketController`, `CanjeController` en la carpeta de controladores

- Modelos: `app/Models/`
  - `User` => app/Models/User.php
  - `Platillo` => app/Models/Platillo.php
  - `Pedido`, `DetallePedido`, `Restaurante` y otros modelos se encuentran en la misma carpeta (`app/Models`).

- Vistas (Blade): `resources/views/`
  - Layouts: resources/views/layouts/app.blade.php
  - Menú digital + carrito lateral: resources/views/men_digital_foodpass/menu_digital.blade.php
  - Vista de carrito dedicada: resources/views/cart/show.blade.php
  - Partials (sidebar, header): resources/views/partials/

- Migrations: `database/migrations/` (creación de tablas y alteraciones)
  - Usuarios: `0001_01_01_000000_create_users_table.php`
  - Migración que añadió `role`: `2026_08_27_000001_add_role_and_sena_to_users_table.php`

- Seeders: `database/seeders/` (si existen)

- Archivos estáticos y JS: `resources/js/`, `resources/css/` y `public/` (salida de Vite / builds).

---

## Cómo funciona el carrito (implementación actual)

- Tipo: basado en sesión (server-side). El carrito se guarda en `session('cart')`.
- Endpoints relevantes (definidos en `routes/web.php`):
  - `GET /cart` → `CartController@show` → renderiza la vista del carrito y calcula `subtotal` y `total` por cada item.
  - `POST /cart/add` → `CartController@add` → valida `platillo_id` y cantidad, y añade o incrementa el producto en la sesión.
  - `POST /cart/update` → `CartController@update` → modifica la cantidad de un producto existente.
  - `POST /cart/remove` → `CartController@remove` → elimina un producto del carrito.

- Estructura de datos: cada item se guarda como un array asociativo indexado por el `id` del platillo:
  - `id`
  - `nombre`
  - `precio`
  - `cantidad`
  - `subtotal` (calculado en el controlador al mostrar la vista)

- Controlador real: `app/Http/Controllers/CartController.php`
  - Usa `$request->session()->get('cart', [])` para leer el carrito.
  - Guarda cambios con `$request->session()->put('cart', $cart)`.
  - El método `show()` calcula el subtotal de cada ítem y el total general antes de enviar la vista.
  - `add()` valida que el platillo exista en `platillos` y evita duplicados sumando la cantidad si ya está presente.

- La vista de confirmación y el panel de compra dependen de esta sesión; no hay persistencia en base de datos todavía, por lo que al recargar o cerrar sesión se puede perder el carrito si no se guarda antes de confirmar el pedido.

---

## Guardar el pedido en Base de Datos (siguiente paso sugerido)

Actualmente la app solo mantiene el carrito en sesión y muestra la UI de confirmación. Para persistir pedidos:

1. Implementar un endpoint POST (ej: `POST /pedidos`) que lea `session('cart')`, valide stock y cree `Pedido` y `DetallePedido` en BD.
2. Al confirmar pedido, vaciar la sesión: `session()->forget('cart')`.

Archivos relacionados existentes: `app/Http/Controllers/PedidoController.php`, migraciones en `database/migrations/*_create_pedidos_table.php` y `*_create_detalle_pedidos_table.php`.

---

## Comandos útiles

- Instalar dependencias: `composer install`
- Migraciones: `php artisan migrate`
- Generar key: `php artisan key:generate`
- Servidor local: `php artisan serve`
- Limpiar caches: `php artisan config:clear && php artisan cache:clear`

---

## Errores comunes y cómo solucionarlos

- Error SQL relacionado con columnas (por ejemplo `Unknown column 'role'`): ejecutar migraciones `php artisan migrate` o revisar que la BD importada no sobrescriba la estructura (el dump puede no contener cambios recientes). La migración `2026_08_27_000001_add_role_and_sena_to_users_table.php` añade `role`.
- Problemas de .env: asegúrate de que .env contiene `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` correctos y reinicia `php artisan config:clear`.

---

## Dónde pedir cambios / next steps
- Implementar persistencia de pedidos (crear `Pedido` y `DetallePedido`).
- Añadir validación de stock en `CartController@add`.
- Mejorar UX del carrito con actualizaciones en tiempo real vía AJAX y mensajes.

---

Si quieres, puedo generar también un diagrama rápido de rutas o implementar el endpoint que persiste el pedido en la base de datos y limpia la sesión. ¿Cuál prefieres que haga ahora?

Fin del documento
