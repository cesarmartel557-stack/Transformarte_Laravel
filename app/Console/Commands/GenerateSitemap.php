<?php

namespace App\Console\Commands;

use App\Models\Curso;
use App\Models\Ebook;
use App\Models\FormatoSesion;
use App\Models\Hero;
use App\Models\SobreMi;
use App\Models\Taller;
use App\Models\Transformarte;
use Carbon\Carbon;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('sitemap:generate')]
#[Description('Genera el archivo sitemap.xml público para motores de búsqueda')]
class GenerateSitemap extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Generando sitemap.xml...');

        $baseUrl = rtrim(config('app.url', url('/')), '/');

        // Determinar la fecha de última modificación más reciente de la Landing Page
        $latestDates = collect([
            Hero::max('updated_at'),
            SobreMi::max('updated_at'),
            Transformarte::max('updated_at'),
            FormatoSesion::max('updated_at'),
            Ebook::max('updated_at'),
            Curso::max('updated_at'),
            Taller::max('updated_at'),
        ])->filter()->map(fn ($date) => Carbon::parse($date));

        $homeLastMod = $latestDates->isNotEmpty()
            ? $latestDates->max()->toDateString()
            : now()->toDateString();

        $urls = [
            [
                'loc' => $baseUrl.'/',
                'lastmod' => $homeLastMod,
                'changefreq' => 'weekly',
                'priority' => '1.0',
            ],
        ];

        // Construir XML estándar de sitemap
        $xml = '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.PHP_EOL;

        foreach ($urls as $url) {
            $xml .= '  <url>'.PHP_EOL;
            $xml .= '    <loc>'.htmlspecialchars($url['loc']).'</loc>'.PHP_EOL;
            $xml .= '    <lastmod>'.$url['lastmod'].'</lastmod>'.PHP_EOL;
            $xml .= '    <changefreq>'.$url['changefreq'].'</changefreq>'.PHP_EOL;
            $xml .= '    <priority>'.$url['priority'].'</priority>'.PHP_EOL;
            $xml .= '  </url>'.PHP_EOL;
        }

        $xml .= '</urlset>'.PHP_EOL;

        $path = public_path('sitemap.xml');
        file_put_contents($path, $xml);

        $this->info("✓ Sitemap generado exitosamente en: {$path}");
        $this->table(['URL', 'Última Modificación', 'Frecuencia', 'Prioridad'], $urls);

        return self::SUCCESS;
    }
}
