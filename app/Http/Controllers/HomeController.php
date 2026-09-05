<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Models\Curso;
use App\Models\Ebook;
use App\Models\Faq;
use App\Models\FormatoSesion;
use App\Models\Herramienta;
use App\Models\Hero;
use App\Models\Material;
use App\Models\SobreMi;
use App\Models\Taller;
use App\Models\Tema;
use App\Models\Testimonio;
use App\Models\Transformarte;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            // Secciones únicas (singleton)
            'hero' => Hero::first(),
            'sobreMi' => SobreMi::first(),
            'transformarte' => Transformarte::with('items')->first(),

            // Listados ordenados
            'sesiones' => FormatoSesion::orderBy('orden')->get(),
            'temas' => Tema::orderBy('orden')->get(),
            'herramientas' => Herramienta::orderBy('orden')->get(),
            'ebooks' => Ebook::all(),
            'materiales' => Material::all(),
            'cursos' => Curso::orderBy('orden')->get(),
            'talleres' => Taller::orderBy('orden')->get(),
            'testimonios' => Testimonio::orderBy('orden')->get(),
            'faqs' => Faq::where('activo', true)->orderBy('orden')->get(),

            // Contacto también para la sección de la home
            'contacto' => Contacto::first(),
        ]);
    }
}
