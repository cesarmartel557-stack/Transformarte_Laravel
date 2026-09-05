# Script de empaquetado para despliegue en Hostinger
# Ejecutar con: powershell -ExecutionPolicy Bypass -File package-hostinger.ps1

Write-Host "==================================================" -ForegroundColor Cyan
Write-Host " Preparando paquete para Hostinger (espaciotransformarte.com)" -ForegroundColor Cyan
Write-Host "==================================================" -ForegroundColor Cyan

$zipName = "hostinger-deploy.zip"

if (Test-Path $zipName) {
    Write-Host "Eliminando archivo previo: $zipName..." -ForegroundColor Yellow
    Remove-Item $zipName -Force
}

Write-Host "1. Compilando assets con Vite (npm run build)..." -ForegroundColor Green
& npm run build

Write-Host "2. Limpiando cachés de Laravel..." -ForegroundColor Green
& php artisan optimize:clear

Write-Host "3. Creando archivo comprimido $zipName..." -ForegroundColor Green
$filesToZip = @(
    "app",
    "bootstrap",
    "config",
    "database",
    "public",
    "resources",
    "routes",
    "storage",
    "vendor",
    "artisan",
    "composer.json",
    "composer.lock",
    ".htaccess",
    ".env.production.example"
)

# Filtramos los elementos que realmente existen
$validPaths = @()
foreach ($f in $filesToZip) {
    if (Test-Path $f) {
        $validPaths += $f
    }
}

# Usamos tar.exe nativo de Windows para garantizar barras inclinadas estándar de Linux (/)
# evitando que los archivos se descompriman con barras invertidas (\) en Hostinger.
& tar -a -c -f $zipName --exclude="node_modules" --exclude=".git" --exclude="storage/logs/*.log" $validPaths

$zipSize = [Math]::Round((Get-Item $zipName).Length / 1MB, 2)

Write-Host "==================================================" -ForegroundColor Cyan
Write-Host " Paquete creado exitosamente: $zipName ($zipSize MB)" -ForegroundColor Green
Write-Host " Listo para subir a public_html en el File Manager de Hostinger." -ForegroundColor Cyan
Write-Host "==================================================" -ForegroundColor Cyan
