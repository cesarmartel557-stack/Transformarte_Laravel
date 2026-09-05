<?php

if (! function_exists('storage_asset')) {
    /**
     * Resuelve la URL pública de un archivo guardado en la base.
     *
     * Acepta rutas legacy dentro de public/ ("assets/img/..."),
     * rutas subidas al disco public ("uploads/...") o URLs absolutas.
     */
    function storage_asset(?string $path, ?string $fallback = null): string
    {
        if ($path) {
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path;
            }

            if (str_starts_with($path, 'assets/')) {
                if (! $fallback || file_exists(public_path($path))) {
                    return asset($path);
                }
            } else {
                $storageRelative = 'storage/'.ltrim($path, '/');
                if (! $fallback || file_exists(public_path($storageRelative)) || file_exists(storage_path('app/public/'.ltrim($path, '/')))) {
                    return asset($storageRelative);
                }
            }
        }

        if ($fallback) {
            if (str_starts_with($fallback, 'http://') || str_starts_with($fallback, 'https://')) {
                return $fallback;
            }

            return asset($fallback);
        }

        return '';
    }
}
