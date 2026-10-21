# Despliegue en alwaysdata Free

Destino: cuenta `libreria-virtual`, sitio [libreria-virtual.alwaysdata.net](https://libreria-virtual.alwaysdata.net/), base pública desechable `libreria-virtual_portfolio_demo` (MariaDB 11.8). La base anterior `libreria-virtual_libreria_virtual` se conserva aparte porque contiene una cuenta y pedidos ajenos a las semillas ficticias.

## Archivos

1. Sube solo el código del repositorio. No subas `.env`, `vendor/`, sesiones, caché, logs, SQL heredado ni imágenes antiguas sin licencia comprobada.
2. En `/home/libreria-virtual/libreria-virtual`, instala dependencias con `composer install --no-dev --optimize-autoloader --no-interaction`.
3. Configura la raíz del sitio PHP en `/home/libreria-virtual/libreria-virtual/public` y PHP 8.2 o superior. El resto del proyecto debe quedar fuera de la raíz pública.

## Configuración privada

Crea un `.env` nuevo en el servidor a partir de `.env.example`, con al menos:

```dotenv
APP_NAME="Libreria Virtual"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://libreria-virtual.alwaysdata.net
DB_CONNECTION=mysql
DB_HOST=mysql-libreria-virtual.alwaysdata.net
DB_PORT=3306
DB_DATABASE=libreria-virtual_portfolio_demo
DB_USERNAME=libreria-virtual
DB_PASSWORD=<contraseña privada de la base>
SESSION_SECURE_COOKIE=true
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
MAIL_MAILER=log
PUBLIC_DEMO_ACCESS=true
DEMO_RESET_DATABASE=libreria-virtual_portfolio_demo
```

Genera `APP_KEY` con `php artisan key:generate`. En modo público, las cuentas ficticias reciben contraseñas aleatorias automáticamente: `DEMO_PASSWORD` no es necesario. No publiques ni compartas el `.env`.

## Inicialización y comprobación

```sh
php artisan migrate --seed --force
php artisan optimize:clear
php artisan config:cache
php artisan view:cache
```

Comprueba `/`, `/catalogo`, el acceso de un clic a cada rol, carrito, confirmación de pedido y seguimiento. En el modo público el registro queda desactivado y el panel de administrador es compartido; usa solo datos ficticios. `demo:reset` borra los cambios en la base desechable indicada por `DEMO_RESET_DATABASE` y falla si detecta cuentas ajenas a las cinco sembradas. Comprueba las cuentas antes de ejecutarlo por primera vez.

En **Avanzado > Tareas programadas** de alwaysdata, crea una tarea de tipo **Comando**, con `php /home/libreria-virtual/libreria-virtual/artisan demo:reset`, frecuencia diaria a las 10:30 del servidor (CEST/CET; aproximadamente 03:30/04:30 en Lima, según la temporada). Comprueba que el primer registro de ejecución termine correctamente en los logs de la tarea. alwaysdata admite comandos y horarios diarios en ese panel: [documentación oficial](https://help.alwaysdata.com/en/docs/web-hosting/tasks/). Si el restablecimiento falla, revisa el log; no vuelvas a sembrar a mano la base existente.

## Renombrado de la cuenta existente

La cuenta se renombró de `alex-portfolio` a `libreria-virtual`. alwaysdata trasladó la raíz web y renombró la base y su usuario. Después se actualizaron la URL y los datos de conexión en el `.env` privado, se reconstruyeron las cachés de Laravel y se reinició el sitio desde el panel. Para abrir los roles al público se creó posteriormente una base nueva y exclusiva para la demo.

MariaDB conservó el usuario anterior como `DEFINER` de las vistas, procedimientos y el disparador. Para restaurar el catálogo y los pedidos sin borrar los datos, se ejecutaron de nuevo los métodos `up()` de `2024_02_07_240000_unprepared_view.php`, `2026_10_19_000000_add_usuario_to_view_pedidos.php`, `2024_02_07_240000_unprepared_procedure.php` y `2024_02_07_240000_unprepared_trigger.php`, en ese orden. Sus definidores ahora son `libreria-virtual@%`. No vuelvas a sembrar la base existente por este cambio.

El plan Free tiene 256 MB de RAM, ¼ CPU y 1 GB de espacio compartido entre archivos y base de datos. Mide el tiempo de carga real antes de usar el enlace en el portfolio.
