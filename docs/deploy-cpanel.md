# Deploy a producción (cPanel / hosting compartido)
### Transformarte — Laravel 13 + Filament v5 + SQLite

> **Nota**: el sitio se deploya en **Hostinger**; la guía definitiva y actualizada es [deploy-hostinger.md](./deploy-hostinger.md). Este documento queda como referencia genérica para hosting con cPanel clásico.

Guía paso a paso para subir el sitio y el panel de administración a un hosting con cPanel. No requiere conocimientos avanzados: seguí los pasos en orden.

---

## Credenciales del panel de administración

| | |
|---|---|
| **URL del panel** | `http://127.0.0.1:8000/admin` (local) o `https://tudominio.com/admin` (producción) |
| **Usuario** | `admin@espaciotransformarte.com` |
| **Contraseña** | `Transformarte2026` |

> **Importante**: apenas subas el sitio a producción, cambiá la contraseña desde el panel (arriba a la derecha, tu usuario → Editar perfil). Una contraseña publicada en un documento deja de ser segura.

---

## 1. Antes de subir: preparar el proyecto en tu máquina

Desde la carpeta del proyecto (con PowerShell):

```powershell
# Compilar el tema del panel de administración (queda en public/build)
npm run build

# Generar cachés de configuración, rutas y vistas (queda todo listo para producción)
C:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe artisan optimize
```

> Si no tenés npm instalado localmente, avisá y compilamos el tema de otra forma. El sitio público no necesita build, solo el panel `/admin`.

## 2. Ajustes de `.env` para producción

Editá el `.env` **solo en el servidor** (nunca el local) y dejalo así:

```env
APP_NAME=Transformarte
APP_ENV=production
APP_KEY=base64:LA_MISMA_CLAVE_QUE_TENES_LOCALMENTE
APP_DEBUG=false
APP_URL=https://www.espaciotransformarte.com

DB_CONNECTION=sqlite
DB_DATABASE=/home/USUARIO/storage/database.sqlite   # ruta absoluta en el servidor

SESSION_DRIVER=file
SESSION_SECURE_COOKIE=true
FILESYSTEM_DISK=public
```

> El `APP_KEY` se copia igual que el de desarrollo (`C:\laragon\www\transformarte\.env`). Si lo cambiás, las sesiones del panel se invalidan.

### Mail del formulario de contacto (SMTP)

El formulario de la web guarda cada mensaje en el panel (**Mensajes**) y además lo envía por mail a la casilla configurada en **Configuración → Contacto**. El envío sale por el SMTP de Hostinger de la casilla `hola@espaciotransformarte.com` (ya probado en desarrollo):

```env
MAIL_MAILER=smtp
MAIL_SCHEME=smtps
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=hola@espaciotransformarte.com
MAIL_PASSWORD=la-contraseña-de-la-casilla
MAIL_FROM_ADDRESS=hola@espaciotransformarte.com
MAIL_FROM_NAME="Espacio Transformarte"
```

> Detalle técnico: con el puerto 465 (SSL implícito) el esquema debe ser `smtps`, no `ssl`.
> Si el SMTP no está configurado o falla, el mensaje **igual queda guardado** y visible en el panel; el error se registra en `storage/logs/laravel.log`.

## 3. Subir los archivos al hosting

1. En tu máquina: comprimí el proyecto en un `.zip` **excluyendo** `node_modules` y `.env`.
2. En cPanel → **Administrador de archivos**: subí el zip fuera de `public_html` (por ejemplo `~/laravel`) y descomprimilo.
3. El documento web tiene que apuntar a la carpeta `public` del proyecto:
   - **Opción A (recomendada)**: en cPanel → **Dominios**, poné el documento raíz de `espaciotransformarte.com` apuntando a `~/laravel/public`.
   - **Opción B**: copiá el contenido de `public` a `public_html` y cambiá en `public/index.php` las rutas `__DIR__.'/../vendor/...'` para que apunten a `~/laravel`.

4. Requisitos del servidor (se configuran en cPanel → **Seleccionar versión de PHP**):
   - PHP **8.2 o superior** (ideal 8.3)
   - Extensiones activas: `pdo_sqlite`, `sqlite3`, `mbstring`, `openssl`, `ctype`, `fileinfo`, `intl`, `zip`, `gd`

## 4. Base de datos y permisos

1. Creá la base SQLite vacía:
   - En cPanel → Administrador de archivos, creá la carpeta `~/storage` y dentro un archivo vacío llamado `database.sqlite` (0 KB).
2. Permisos (cPanel → Administrador de archivos → Permisos):
   - `~/storage` → **755** y todo su contenido con escritura (Laravel necesita escribir en `storage/logs`, `storage/app` y `storage/framework`).
   - Carpeta del proyecto → 755.
3. Si querés subir los datos que ya tenés localmente: reemplazá `database.sqlite` por una copia del archivo `C:\laragon\www\transformarte\database\database.sqlite`.

## 5. Comandos finales en el servidor

Abrí la terminal de cPanel (o el Terminal integrado) y ejecutá:

```bash
cd ~/laravel
php artisan migrate --force
php artisan storage:link
php artisan optimize
```

`storage:link` crea el enlace simbólico para que las imágenes subidas desde el panel se vean en el sitio (`/storage/...`).

## 6. Verificación post-deploy

Abrí en el navegador y confirmá:

| URL | Qué debe pasar |
|---|---|
| `https://www.espaciotransformarte.com/` | El sitio carga con todo el contenido |
| `https://www.espaciotransformarte.com/gracias` | La página de gracias con el WhatsApp |
| `https://www.espaciotransformarte.com/ruta-inexistente` | La página 404 con el estilo del sitio |
| `https://www.espaciotransformarte.com/robots.txt` | Se ve el robots con el sitemap |
| `https://www.espaciotransformarte.com/admin` | El login del panel |

Iniciá sesión en `/admin` con tus credenciales y probá subir una imagen para confirmar que los permisos de `storage` están bien.

> **Importante**: cambiá la contraseña del admin desde `/admin` (arriba a la derecha, tu usuario) apenas lo pongas en producción.

## 7. Backups de SQLite (rutina recomendada)

SQLite es un solo archivo: el backup es **copiar ese archivo**.

### Manual
Cada vez que cargues contenido importante:
1. cPanel → Administrador de archivos → `~/storage/database.sqlite`
2. Descargalo y guardalo con fecha: `database-2026-08-10.sqlite`

### Automático (cron en cPanel)
En cPanel → **Tareas de cron**, agregá una tarea diaria (ej.: 3:00 AM) con:

```bash
cp ~/storage/database.sqlite ~/backups/database-$(date +\%F).sqlite && find ~/backups -name "database-*.sqlite" -mtime +30 -delete
```

Esto copia la base todos los días a `~/backups` y borra las copias de más de 30 días.

### Backup de imágenes subidas
Las imágenes que subís desde el panel viven en `~/laravel/storage/app/public`. Incluí esa carpeta en el backup (o descargala junto con la base cada tanto).

---

## Resumen rápido

1. `npm run build` + `php artisan optimize` local
2. Zip sin `node_modules` ni `.env` → subir a `~/laravel`
3. Dominio apuntando a `~/laravel/public`, PHP 8.3 + `pdo_sqlite`
4. Crear `~/storage/database.sqlite`, permisos 755
5. `php artisan migrate --force && php artisan storage:link && php artisan optimize`
6. Verificar las URLs, cambiar contraseña del admin
7. Cron diario de backup de `database.sqlite` + carpeta `storage/app/public`
