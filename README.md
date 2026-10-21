# Librería Virtual

Demo interactiva en Laravel para administrar libros y ejemplares, registrar pedidos y simular el seguimiento de envíos. Hay cuatro roles: administrador, cliente ocasional, cliente especializado y encargado de envíos. El catálogo público se puede explorar sin cuenta.

**Demo pública:** [libreria-virtual.alwaysdata.net](https://libreria-virtual.alwaysdata.net/) · **Código:** [GitHub](https://github.com/AlexDeRivia/libreria-virtual).

**La compra y el envío son simulados.** Confirmar un pedido calcula el costo de envío y crea un código de seguimiento interno; no cobra dinero ni se integra con un transportista. El botón «1 Clic» añade ejemplares al carrito. La demo no solicita ni guarda datos de tarjetas nuevas.

## Requisitos

- PHP 8.2 o superior, con `pdo_mysql`, `mbstring`, `openssl`, `fileinfo` y las extensiones habituales de Laravel.
- Composer 2.
- MySQL 8.0.30 o MariaDB 11.8. Las migraciones crean vistas, procedimientos y un disparador, así que el usuario de instalación necesita esos permisos.
- Un servidor PHP que sirva **solo** la carpeta `public/` como raíz web.

Las vistas usan los archivos CSS y JS incluidos en `public/dist`. Node y Vite no son necesarios para arrancar esta demo.

## Instalación local desde una base vacía

1. Crea una base MySQL exclusiva para la demo y un usuario con permisos para migraciones, vistas, procedimientos y disparadores. No importes la base antigua.
2. En una copia limpia del proyecto, copia `.env.example` a `.env`. Si ya existe un `.env` antiguo, consérvalo aparte: no lo reutilices ni apuntes la demo a su base de datos. Configura `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` y `DB_PASSWORD`. Define `DEMO_PASSWORD` con una contraseña privada de al menos 12 caracteres para las cuentas de ejemplo.
3. Ejecuta:

   ```powershell
   composer install
   php artisan key:generate
   php artisan migrate --seed
   php artisan serve --host=127.0.0.1
   ```

4. Abre `http://127.0.0.1:8000`. Las cuentas sembradas usan los correos `admin@example.test`, `cliente@example.test`, `especialista@example.test` y `envios@example.test`, con la contraseña que configuraste. Mantén privadas las credenciales de administrador y encargado. Los visitantes pueden crear una cuenta de cliente con **datos ficticios**.

## Recorrido de la demo

1. Entra en `/catalogo` para explorar y buscar sin iniciar sesión. El catálogo es de solo lectura.
2. Regístrate como cliente con datos ficticios o ingresa con una cuenta de cliente sembrada. Añade ejemplares al carrito y confirma un pedido simulado. Las unidades del carrito quedan reservadas durante 30 minutos desde el último cambio; al vencer, se liberan en la siguiente visita al catálogo o al área de cliente.
3. Consulta el historial y el detalle del pedido para ver su código de seguimiento interno y su estado. El administrador puede consultar los artículos y destinatario en el detalle del pedido.
4. Ingresa como encargado de envíos. Marca el pedido «En camino» con una fecha estimada y luego «Entregado». El historial del cliente conserva el pedido entregado y muestra la fecha registrada.

`migrate --seed` se usa una vez sobre una base vacía. `migrate:fresh --seed` elimina los datos de la base seleccionada: úsalo únicamente para reiniciar una demo desechable.

## Pruebas

Las pruebas de integración se niegan a usar otra base que no sea `libreria_virtual_test` en MySQL local. Créala por separado y configura la conexión mediante variables de entorno antes de ejecutar:

```powershell
$env:APP_ENV = "testing"
$env:DB_HOST = "127.0.0.1"
$env:DB_DATABASE = "libreria_virtual_test"
$env:DEMO_PASSWORD = "<contraseña privada de 12+ caracteres>"
php artisan migrate --seed --force
php artisan test
```

Usa `DB_PORT`, `DB_USERNAME` y `DB_PASSWORD` de esa instancia de pruebas cuando difieran de tu `.env`. Los tests usan transacciones; el esquema y las semillas deben existir antes de correrlos.

## Antes de desplegar

- Configura una base nueva y privada. No copies el `.env`, los logs, las sesiones ni datos de tarjetas del proyecto antiguo. Los bocetos SQL de `database/` no forman parte de la instalación.
- Usa un `APP_KEY` nuevo, `APP_ENV=production`, `APP_DEBUG=false`, la URL HTTPS real, `SESSION_SECURE_COOKIE=true` y un almacén de caché persistente para limitar intentos de acceso. Asegura escritura en `storage/` y `bootstrap/cache/`.
- Instala desde `composer.lock` y ejecuta `composer audit --locked` antes de publicar. En un servidor de producción usa `composer install --no-dev --optimize-autoloader`.
- Sirve exclusivamente `public/`. Mantén privadas las credenciales de los roles internos y decide cómo restablecer los pedidos confirmados de la demo si otras personas pueden crearlos. Las reservas abandonadas se liberan al recibir una visita posterior; no se requiere un cron para esta demo.
- Confirma la autoría y permisos de uso de las imágenes y archivos de terceros incluidos en `public/` antes de mostrarlos públicamente.

El despliegue gratuito en alwaysdata se documenta en [docs/deploy-alwaysdata.md](docs/deploy-alwaysdata.md). Las imágenes heredadas y sin uso de `public/img/` se excluyen del repositorio y del despliegue hasta confirmar sus permisos.

No hay integración de pagos, correo transaccional ni seguimiento externo de envíos. El proyecto original carecía de historial Git; esta recuperación conserva una copia de referencia local aparte.

© 2026 Alex Alcantara · Librería Virtual. Todos los derechos reservados. Los componentes de terceros conservan sus propias licencias.
