# Despliegue en alwaysdata Free

Destino: cuenta `alex-portfolio`, sitio [alex-portfolio.alwaysdata.net](https://alex-portfolio.alwaysdata.net/), base `alex-portfolio_libreria_virtual` (MariaDB 11.8). Las migraciones, incluidos los procedimientos, las vistas y el disparador, se ejecutaron correctamente en este servidor.

## Archivos

1. Sube solo el código del repositorio. No subas `.env`, `vendor/`, sesiones, caché, logs, SQL heredado ni imágenes antiguas sin licencia comprobada.
2. En `/home/alex-portfolio/libreria-virtual`, instala dependencias con `composer install --no-dev --optimize-autoloader --no-interaction`.
3. Configura la raíz del sitio PHP en `/home/alex-portfolio/libreria-virtual/public` y PHP 8.2 o superior. El resto del proyecto debe quedar fuera de la raíz pública.

## Configuración privada

Crea un `.env` nuevo en el servidor a partir de `.env.example`, con al menos:

```dotenv
APP_NAME="Libreria Virtual"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://alex-portfolio.alwaysdata.net
DB_CONNECTION=mysql
DB_HOST=mysql-alex-portfolio.alwaysdata.net
DB_PORT=3306
DB_DATABASE=alex-portfolio_libreria_virtual
DB_USERNAME=alex-portfolio
DB_PASSWORD=<contraseña privada de la base>
SESSION_SECURE_COOKIE=true
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
MAIL_MAILER=log
```

Genera `APP_KEY` con `php artisan key:generate`. Para la siembra inicial, pasa `DEMO_PASSWORD` como variable temporal del proceso y retírala de la sesión al terminar. No la guardes en el `.env` ni en el historial de comandos. No publiques ni compartas el `.env`.

## Inicialización y comprobación

```sh
php artisan migrate --force
# Ejecuta la siembra una sola vez con una clave de 12+ caracteres.
read -r -s -p 'Clave demo: ' demo_pass
DEMO_PASSWORD="$demo_pass" php artisan db:seed --force
unset demo_pass
php artisan optimize:clear
php artisan config:cache
php artisan view:cache
```

Comprueba `/`, `/catalogo`, registro de cliente, carrito, confirmación de pedido y seguimiento; entra a los roles internos solo con credenciales privadas. La demo permite que visitantes creen datos ficticios. Reinicia o limpia los pedidos de la demo de forma deliberada si se acumulan; nunca ejecutes `migrate:fresh` sobre una base con datos que debas conservar.

El plan Free tiene 256 MB de RAM, ¼ CPU y 1 GB de espacio compartido entre archivos y base de datos. Mide el tiempo de carga real antes de usar el enlace en el portfolio.
