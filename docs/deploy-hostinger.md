# Deploy a producción — Hostinger (hPanel)
### Transformarte — Laravel 13 + Filament v5 + SQLite

Guía paso a paso para subir el sitio a Hostinger **sin usar terminal ni SSH**: todo se hace desde el Administrador de archivos del hPanel y el navegador.

**Archivo para subir:** `transformarte-prod.zip` (está en la carpeta del proyecto, ~166 MB). Ya trae todo listo: código, dependencias (`vendor`), tema del panel compilado, base de datos con tu contenido y las imágenes subidas.

---

## Credenciales del panel de administración

| | |
|---|---|
| **URL del panel** | `https://www.espaciotransformarte.com/gestion` |
| **Usuario** | `admin@espaciotransformarte.com` |
| **Contraseña** | `Transformarte2026` |

> **Importante**: apenas el sitio esté online, cambiá la contraseña desde el panel (arriba a la derecha, tu usuario → Editar perfil). Una contraseña publicada en un documento deja de ser segura.

---

## 1. Preparar Hostinger (2 minutos)

### SSL (candadito https)
1. hPanel → **Seguridad → SSL**
2. Si `espaciotransformarte.com` todavía no tiene SSL, instalalo (botón **Install SSL**)
3. Activá **Force HTTPS** para que todo el sitio cargue con https

### Versión de PHP
1. hPanel → **Avanzado → Configuración de PHP**
2. En la pestaña **PHP Configuration** elegí **PHP 8.3 o 8.4** (el sitio necesita 8.3 mínimo)
3. En la pestaña **PHP Extensions** verificá que estén activas: `pdo_sqlite`, `sqlite3`, `mbstring`, `openssl`, `fileinfo`, `intl`, `gd`, `zip` (normalmente ya vienen activas por defecto)
4. Guardá los cambios

## 2. Subir los archivos

1. hPanel → **Archivos → Administrador de archivos**
2. Entrá a la carpeta **`public_html`**
3. Borrá lo que haya adentro (archivos por defecto de Hostinger como `default.php` y el `.htaccess` existente)
4. Clic en **Subir archivos** (ícono de flecha) y subí `transformarte-prod.zip`
   - Si el Administrador de archivos rechaza el zip por tamaño, subilo por FTP (hPanel → Archivos → **Cuentas FTP** te da host/usuario; usá FileZilla) y después descomprimilo desde el Administrador de archivos
5. Clic derecho sobre el zip → **Extraer** → confirmá extraer en `public_html`
6. Cuando termine, borrá el zip del servidor para liberar espacio

> Al descomprimir van a quedar a la vista carpetas como `app`, `vendor`, `database`, `storage`, `public`, etc. **Es correcto**: el `.htaccess` que viene en el zip hace que la web solo exponga la carpeta `public`; todo lo demás queda inaccesible desde internet.

## 3. Crear el archivo `.env` de producción

1. En el Administrador de archivos, dentro de `public_html`, clic en **Nuevo archivo** → nombre: `.env`
2. Abrilo y pegá exactamente este contenido:

```env
APP_NAME=Transformarte
APP_ENV=production
APP_KEY=base64:+RmZk5bdlTyqbMKq0ddSl5lU3DEU6KLD8AicOufzHP0=
APP_DEBUG=false
APP_URL=https://www.espaciotransformarte.com

APP_LOCALE=es
APP_FALLBACK_LOCALE=en

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_LEVEL=error

DB_CONNECTION=sqlite

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_SECURE_COOKIE=true

FILESYSTEM_DISK=public
QUEUE_CONNECTION=sync
CACHE_STORE=file

MAIL_MAILER=smtp
MAIL_SCHEME=smtps
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=465
MAIL_USERNAME=hola@espaciotransformarte.com
MAIL_PASSWORD="Eynoted5@"
MAIL_FROM_ADDRESS=hola@espaciotransformarte.com
MAIL_FROM_NAME="Espacio Transformarte"

TURNSTILE_SITE_KEY=<clave pública de Cloudflare Turnstile>
TURNSTILE_SECRET_KEY=<clave secreta de Cloudflare Turnstile>
```

Notas:
- El `APP_KEY` es el mismo que en desarrollo; si lo cambiás, las sesiones del panel se invalidan.
- Si el dominio va a usarse **sin** `www`, cambiá `APP_URL` a `https://espaciotransformarte.com`.
- Detalle técnico del mail: con el puerto 465 (SSL implícito) el esquema debe ser `smtps`, no `ssl`.
- Las claves `TURNSTILE_*` protegen el login del panel con un captcha invisible (Cloudflare Turnstile). Se crean gratis en dash.cloudflare.com → Turnstile → Add site (dominio `espaciotransformarte.com`, modo "Managed"). Si se dejan vacías, el widget no se muestra y el login funciona sin captcha.

## 4. Finalizar el deploy (1 clic)

Abrí en el navegador:

```
https://www.espaciotransformarte.com/finish-deploy.php
```

El script va a mostrar en pantalla lo que hace: crea el enlace de imágenes, revisa las migraciones y genera los cachés de producción. Tiene que terminar con el mensaje **"LISTO. El deploy quedó completo."**

Después: **borrá el archivo `public/finish-deploy.php` del servidor** (es de un solo uso).

## 5. Verificación

| URL | Qué debe pasar |
|---|---|
| `https://www.espaciotransformarte.com/` | El sitio carga con todo el contenido y las imágenes |
| `https://www.espaciotransformarte.com/gracias` | La página de gracias con el botón de WhatsApp |
| `https://www.espaciotransformarte.com/ruta-inexistente` | La página 404 con el estilo del sitio |
| `https://www.espaciotransformarte.com/robots.txt` | El robots con la referencia al sitemap |
| `https://www.espaciotransformarte.com/gestion` | El login del panel con el logo |

1. Entrá a `/gestion` con las credenciales de arriba
2. Probá **editar la portada y subir una imagen nueva**: confirmá que se guarda y que se ve en el sitio público (esto valida el enlace de storage)
3. Probá el **formulario de contacto** desde el sitio y verificá que llegue el mail a `hola@espaciotransformarte.com` (revisá spam la primera vez) y que aparezca en **Mensajes** del panel
4. **Cambiá la contraseña del admin** (arriba a la derecha → Editar perfil)

## 6. Solución de problemas

| Síntoma | Causa probable / solución |
|---|---|
| Error 500 en blanco | Falta el `.env` o el `APP_KEY` no coincide. Revisá el paso 3 |
| Error 500 con detalles técnicos | `APP_DEBUG` quedó en `true`; ponela en `false` (por seguridad) |
| El panel `/gestion` se ve sin estilos | `finish-deploy.php` no se ejecutó o falló. Volvé al paso 4 |
| El sitio carga pero las imágenes subidas NO se ven | `finish-deploy.php` no terminó bien. Fijate qué mensaje dio; la carpeta de imágenes es `public_html/public/storage` |
| Página en blanco al entrar a `/gestion` | Versión de PHP menor a 8.3. Revisá el paso 1 |
| Error 403 después de hacer login en el panel | Falta `canAccessPanel()` en `app/Models/User.php` (requisito de Filament cuando `APP_ENV` no es `local`). Resubí ese archivo |
| Los mails del formulario no llegan | Verificá la contraseña SMTP en el `.env` y revisá la carpeta spam; los mensajes igual quedan guardados en el panel (**Mensajes**) |

## 7. Backups (rutina recomendada)

Hostinger hace backups del hosting según tu plan, pero la forma más simple y segura de respaldar este sitio es bajar **dos cosas** cada vez que cargues contenido importante:

1. **La base de datos**: `public_html/database/database.sqlite` (un solo archivo con todo el contenido)
2. **Las imágenes subidas**: la carpeta `public_html/storage/app/public`

Guardalas con fecha, por ejemplo `backup-2026-08-14`. Para restaurar, se vuelven a subir al mismo lugar.

---

## Resumen rápido

1. SSL instalado + Force HTTPS, PHP 8.3/8.4
2. `public_html` vacía → subir y extraer `transformarte-prod.zip`
3. Crear `.env` con el contenido del paso 3
4. Abrir `finish-deploy.php` una vez → debe decir "LISTO" → borrar el archivo
5. Verificar las URLs, probar subir una imagen y el formulario, cambiar la contraseña del admin
