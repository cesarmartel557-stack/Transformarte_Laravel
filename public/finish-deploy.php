<?php

/**
 * Script de finalización de deploy — ejecutar UNA sola vez en el navegador:
 *
 *     https://www.espaciotransformarte.com/finish-deploy.php
 *
 * Requisitos antes de ejecutarlo:
 *   1. El zip del proyecto ya está descomprimido en public_html
 *   2. El archivo .env de producción ya fue creado (ver docs/deploy-hostinger.md)
 *
 * Qué hace:
 *   1. Deja public/storage como carpeta real con las imágenes del sitio
 *      (el hosting no permite enlaces simbólicos) y configura el disco
 *      "public" de Laravel para que las subidas nuevas del panel se
 *      guarden directamente ahí.
 *   2. Corre las migraciones por si faltara alguna tabla (no toca datos existentes).
 *   3. Genera los cachés de configuración, rutas y vistas para producción.
 *
 * IMPORTANTE: después de que muestre "LISTO", BORRAR este archivo del servidor.
 */

header('Content-Type: text/plain; charset=utf-8');

$envPath = __DIR__.'/../.env';

if (! file_exists($envPath)) {
    echo 'ERROR: todavía no existe el archivo .env en la raíz del proyecto.'.PHP_EOL;
    echo 'Crealo en public_html/.env con el contenido de la guía de deploy y volvé a ejecutar este script.'.PHP_EOL;
    exit(1);
}

// ── Preparación ANTES de arrancar Laravel ──────────────────────────────

// 1) Carpeta de imágenes pública.
// El hosting no permite symlink()/exec(), así que public/storage queda
// como carpeta real y el disco "public" apunta directo a ella.
if (! is_dir(__DIR__.'/storage')) {
    // Restaurar la copia del zip si una corrida previa la movió a backup
    $backups = glob(__DIR__.'/storage-backup-*');
    if (! empty($backups)) {
        rename(end($backups), __DIR__.'/storage');
        echo '- public/storage restaurada desde el backup'.PHP_EOL;
    } elseif (is_dir(__DIR__.'/../storage/app/public')) {
        mkdir(__DIR__.'/storage', 0755);
        echo '- public/storage creada vacía'.PHP_EOL;
    }
}

// 2) Configurar PUBLIC_DISK_ROOT en el .env (ruta absoluta del servidor).
// Se hace antes de bootear Laravel para que optimize cachee el valor correcto.
$env = file_get_contents($envPath);
$diskRoot = __DIR__.'/storage';
if (! str_contains($env, 'PUBLIC_DISK_ROOT=')) {
    file_put_contents($envPath, rtrim($env).PHP_EOL.PHP_EOL.'PUBLIC_DISK_ROOT="'.$diskRoot.'"'.PHP_EOL);
    echo '- .env actualizado: PUBLIC_DISK_ROOT="'.$diskRoot.'"'.PHP_EOL;
}
@unlink(__DIR__.'/../bootstrap/cache/config.php');

// 3) Garantizar las carpetas de escritura que Laravel necesita
// (el zip puede no traerlas y sin ellas el sitio responde 500).
$carpetas = [
    '/storage/framework/sessions',
    '/storage/framework/views',
    '/storage/framework/cache',
    '/storage/framework/cache/data',
    '/storage/logs',
    '/storage/app/public',
    '/storage/app/private',
    '/bootstrap/cache',
];
foreach ($carpetas as $c) {
    $ruta = __DIR__.'/..'.$c;
    if (! is_dir($ruta)) {
        mkdir($ruta, 0755, true);
        echo '- Carpeta creada: '.$c.PHP_EOL;
    }
}

// ── Arranque de Laravel ─────────────────────────────────────────────────

require __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

try {
    $kernel->call('migrate', ['--force' => true]);
    $kernel->call('optimize');

    echo $kernel->output();

    // Prueba de arranque: pide la home como petición HTTP real (en un
    // proceso separado; probarla dentro del mismo proceso comparte estado
    // con los comandos artisan y da falsos errores).
    $homeUrl = rtrim(config('app.url'), '/').'/';
    $codigo = null;
    try {
        $contexto = stream_context_create(['http' => ['ignore_errors' => true, 'timeout' => 30]]);
        $fp = fopen($homeUrl, 'r', false, $contexto);
        if ($fp) {
            fclose($fp);
            if (isset($http_response_header[0]) && preg_match('/(\d{3})/', $http_response_header[0], $m)) {
                $codigo = (int) $m[1];
            }
        }
        echo '- La home responde: HTTP '.($codigo ?? 'desconocido')." ($homeUrl)".PHP_EOL;
    } catch (Throwable $e) {
        echo '- No se pudo pedir la home: '.$e->getMessage().PHP_EOL;
    }

    if ($codigo !== null && $codigo >= 500) {
        echo 'La home sigue fallando. El detalle está en el bloque de abajo.'.PHP_EOL;
    }

    if ($codigo !== null && $codigo >= 500) {
        $log = __DIR__.'/../storage/logs/laravel.log';
        if (file_exists($log)) {
            // El mensaje del error está en la última línea "production.ERROR:"
            // (la pila de llamadas viene debajo y no aporta).
            $contenido = file_get_contents($log);
            $pos = strrpos($contenido, '.ERROR:');
            echo PHP_EOL.'--- Error registrado en storage/logs/laravel.log ---'.PHP_EOL;
            if ($pos !== false) {
                $linea = substr($contenido, $pos, 2500);
                $salto = strpos($linea, "\n");
                echo ($salto !== false ? substr($linea, 0, $salto) : $linea).PHP_EOL;
            } else {
                echo implode('', array_slice(file($log), -5));
            }
        }
    }

    if (is_dir(__DIR__.'/storage') && str_contains(file_get_contents($envPath), 'PUBLIC_DISK_ROOT=')) {
        echo PHP_EOL.'LISTO. El deploy quedó completo.'.PHP_EOL;
        echo 'Ahora BORRÁ este archivo (public/finish-deploy.php) del servidor.'.PHP_EOL;
    } else {
        echo PHP_EOL.'ATENCIÓN: revisá los mensajes de arriba; algo no quedó configurado.'.PHP_EOL;
    }
} catch (Throwable $e) {
    echo 'ERROR: '.$e->getMessage().PHP_EOL;
    exit(1);
}
