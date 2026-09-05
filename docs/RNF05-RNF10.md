# Informe RNF05-RNF10

## RNF05: Protección de datos

- Se agregó `DELETE /usuarios/mi-cuenta`, protegido por autenticación.
- La eliminación se ejecuta en una transacción y cierra la sesión. Las relaciones personales existentes usan borrado en cascada.
- La política está disponible en `/privacidad` y desde el perfil. Describe finalidades, derechos de consulta, actualización, rectificación, supresión y retiro de autorización.

## RNF06: Rate limiting

El limiter `foodpass` permite 100 solicitudes por minuto por usuario autenticado o IP. Se aplica a pedidos, canjes y pagos. Cuando se supera el límite responde `429` con un mensaje JSON claro y cabeceras de rate limit.

## RNF07: Errores

En solicitudes JSON con `APP_DEBUG=false`, el manejador devuelve solo mensajes amigables y códigos `400`, `401`, `403`, `404`, `422` o `500`. No incluye excepciones, rutas ni stack traces. Laravel conserva las respuestas de validación y autenticación con sus códigos estándar.

## RNF08: Redis y menú

`CACHE_STORE=redis`, `CACHE_DRIVER=redis` y `REDIS_CLIENT=predis` están configurados. `MenuDigitalController` usa `Cache::remember('menu_del_dia', 300, ...)`. Los eventos `saved` y `deleted` de `Platillo` invalidan esa clave.

Requisito operativo: iniciar Redis en `127.0.0.1:6379` antes de ejecutar la aplicación o el scheduler.

## RNF09: Prueba de carga

Escenario creado en `tests/load/foodpass.js`: 500 usuarios virtuales concurrentes durante un minuto contra `GET /pedidos`, con umbrales de menos de 1% de errores y p95 menor a 1000 ms.

Ejecutar con:

```text
k6 run -e BASE_URL=http://127.0.0.1:8000 -e AUTH_TOKEN=TOKEN tests/load/foodpass.js
```

Resultados de esta entrega: **pendientes de ejecución**, porque k6 y un servidor Redis activo no están disponibles en el entorno actual. Deben registrarse aquí el promedio, p95, errores y throughput generados por k6. No se declara rendimiento medido sin ejecutar el escenario contra la infraestructura objetivo.

## RNF10: Sincronización SENA

- Se creó `beneficiarios_sena` y el comando `php artisan sena:sync`.
- El comando descifra el contenido completo del CSV con la clave de `APP_KEY`, valida correo/nombre, hace upsert, marca inactivos los ausentes y sincroniza `users.es_beneficiario_sena`.
- El archivo por defecto es `storage/app/private/sena/beneficiarios.csv.enc`; también puede indicarse con `--file`.
- El scheduler registra `sena:sync` con `daily()`, equivalente a ejecución diaria a medianoche según el timezone configurado.

Formato del CSV antes de cifrarlo: `documento,nombre,email`.