# Informe de implementación FoodPass

## Alcance

Se implementaron los requisitos no funcionales RNF05 a RNF10 para protección de datos, limitación de tráfico, manejo seguro de errores, caché Redis, pruebas de carga y sincronización con la base de datos SENA.

## RNF05: Protección de datos personales

Se creó `DELETE /usuarios/mi-cuenta`, protegido por el middleware `auth`. El controlador elimina al usuario dentro de una transacción, cierra la sesión, invalida el token CSRF y devuelve una confirmación JSON o una redirección al login.

La eliminación aprovecha las claves foráneas existentes con `onDelete('cascade')` para pedidos, canjes, transacciones, tarjetas de pago y tickets asociados. La política de privacidad está disponible en `/privacidad` y desde la pantalla de perfil. Allí se explican finalidades, derechos de consulta, actualización, rectificación, supresión, retiro de autorización y el canal de soporte.

Archivos principales: `app/Http/Controllers/CuentaController.php`, `resources/views/privacidad.blade.php`, `routes/web.php` y `resources/views/mi_perfil_foodpass/perfil.blade.php`.

## RNF06: Rate limiting general

Se registró el limiter nombrado `foodpass` en `AppServiceProvider`. Permite 100 solicitudes por minuto agrupadas por identificador del usuario autenticado o, en su defecto, por dirección IP.

El middleware se aplicó a los métodos de pedidos, canjes y pagos. Al exceder el límite se devuelve HTTP `429` y el mensaje: “Has superado el límite de 100 solicitudes por minuto. Inténtalo de nuevo más tarde.” También se incluyen cabeceras del límite.

## RNF07: Manejo seguro de errores

En `bootstrap/app.php` se configuró el manejador moderno de excepciones de Laravel 12. Para solicitudes JSON con `APP_DEBUG=false`, las excepciones se convierten en respuestas amigables con códigos `400`, `401`, `403`, `404`, `422` o `500`, según corresponda. No se exponen stack traces, rutas internas ni mensajes técnicos.

## RNF08: Caché Redis

Se agregó `predis/predis` como dependencia y se configuraron `CACHE_STORE=redis`, `CACHE_DRIVER=redis`, `REDIS_CLIENT=predis` y la conexión local en `.env` y `.env.example`.

El menú usa exactamente la clave `menu_del_dia` con una duración de 300 segundos mediante `Cache::remember`. Los eventos `saved` y `deleted` del modelo `Platillo` invalidan la clave automáticamente, incluyendo creación, edición, cambio de disponibilidad y eliminación.

## RNF09: Prueba de carga

Se creó `tests/load/foodpass.js` con k6. El escenario mantiene 500 usuarios virtuales concurrentes durante un minuto contra `GET /pedidos`.

Umbrales definidos:

- Menos de 1% de solicitudes fallidas.
- Percentil 95 de respuesta menor a 1000 ms.

Ejecución:

```text
k6 run -e BASE_URL=http://127.0.0.1:8000 -e AUTH_TOKEN=TOKEN tests/load/foodpass.js
```

Las métricas de promedio, errores y throughput quedan pendientes de ejecutar contra la infraestructura objetivo. No se registraron valores ficticios. k6 y un servidor Redis activo no estaban disponibles en el entorno de desarrollo durante esta entrega.

## RNF10: Sincronización SENA

Se creó la migración de `beneficiarios_sena` con documento, nombre, correo, estado activo y fecha de sincronización.

El comando `php artisan sena:sync`:

1. Lee el archivo configurado en `SENA_BENEFICIARIES_FILE`.
2. Descifra su contenido usando `Crypt` y la clave `APP_KEY`.
3. Valida las columnas `nombre` y `email`.
4. Actualiza o inserta beneficiarios por correo.
5. Marca como inactivos los registros que ya no aparecen.
6. Sincroniza `users.es_beneficiario_sena`.

El formato esperado del CSV es `documento,nombre,email`. El archivo predeterminado es `storage/app/private/sena/beneficiarios.csv.enc`. El scheduler registra `sena:sync` con `daily()`, cuya expresión verificada es `0 0 * * *`.

## Validaciones realizadas

- Sintaxis PHP validada en todos los archivos modificados.
- Rutas de cuenta, pedidos, canjes y pagos verificadas con `php artisan route:list`.
- Middleware `throttle:foodpass` comprobado en las rutas requeridas.
- Comando `sena:sync` visible en Artisan.
- Scheduler verificado a medianoche usando caché de prueba.
- Diagnósticos del editor sin errores en los archivos modificados.
- PHPUnit: 2 pruebas exitosas y 3 aserciones.

## Requisitos para producción

1. Ejecutar `composer install`.
2. Configurar una clave `APP_KEY` y variables reales en `.env`.
3. Tener Redis activo en `127.0.0.1:6379` o cambiar sus variables de conexión.
4. Ejecutar `php artisan migrate --force`.
5. Crear el CSV cifrado usando la misma `APP_KEY` de la aplicación.
6. Mantener un proceso de scheduler, por ejemplo `php artisan schedule:work`, o configurar el cron de Laravel.
7. Ejecutar la prueba k6 contra la URL y token de la infraestructura real y añadir sus métricas a este informe.