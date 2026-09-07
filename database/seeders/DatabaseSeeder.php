<?php

namespace Database\Seeders;

use App\Models\Configuracion;
use App\Models\Contacto;
use App\Models\Curso;
use App\Models\Ebook;
use App\Models\Faq;
use App\Models\FormatoSesion;
use App\Models\Gracias;
use App\Models\Hero;
use App\Models\Herramienta;
use App\Models\Material;
use App\Models\SobreMi;
use App\Models\Taller;
use App\Models\Tema;
use App\Models\Testimonio;
use App\Models\Transformarte;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // -------------------------------------------------
        // Usuario administrador del panel
        // -------------------------------------------------
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@espaciotransformarte.com',
            'password' => bcrypt('Transformarte2026'),
        ]);

        // -------------------------------------------------
        // Hero
        // -------------------------------------------------
        Hero::create([
            'titulo' => 'El viaje hacia tu propia grandeza',
            'subtitulo' => 'Un espacio para conocerte mejor, decidir con más claridad y avanzar hacia proyectos con sentido.',
            'boton_texto' => 'Agendar una Sesión',
            'boton_url' => 'https://calendar.app.google/yyE2dN7uzjg9H9TR9',
            'imagen' => $this->publicar('assets/img/banner-hero.jpg'),
        ]);

        // -------------------------------------------------
        // Quién soy
        // -------------------------------------------------
        SobreMi::create([
            'titulo' => 'Hola, soy <br>Gabo Patitó',
            'parrafo_1' => 'Soy coach ontológico certificado por la ICF y mi compromiso con el mundo es acompañar a las personas en su proceso de transformación interior.',
            'parrafo_2' => 'Mi trabajo es acompañarte a clarificar lo que realmente querés y avanzar hacia una vida más coherente y alineada a tu propósito.',
            'imagen' => $this->publicar('assets/img/Gabo-Patito.jpg'),
            'imagen_felino' => $this->publicar('assets/img/felino.png'),
            'cta_texto' => 'Descubre TransformArte',
        ]);

        // -------------------------------------------------
        // Transformarte + items
        // -------------------------------------------------
        $transformarte = Transformarte::create([
            'insignia' => 'Transformarte',
            'titulo' => 'Un espacio <br>para crecer',
            'parrafo_1' => 'Creo que cada persona tiene dentro suyo los recursos que necesita. Mi rol es acompañarte a descubrirlos y ponerlos en acción. Trabajo desde un espacio de profundo respeto, escucha activa y confidencialidad absoluta.',
            'parrafo_2' => 'Porque la transformación genuina empieza cuando te sentís seguro de ser quien realmente sos. Por eso, me interesa que cada encuentro no quede solo en una conversación amena: trabajamos para que te lleves claridad y próximos pasos concretos',
            'imagen' => $this->publicar('assets/img/mujer-ojos.jpg'),
        ]);

        $transformarte->items()->createMany([
            [
                'icono' => $this->publicar('assets/img/icon-01.png'),
                'titulo' => 'Proceso personal',
                'texto' => 'Un acompañamiento a medida donde trabajamos sobre lo que vos traés. Sin recetas  prefabricadas. Con tiempo para profundizar en lo que realmente importa.',
                'orden' => 1,
            ],
            [
                'icono' => $this->publicar('assets/img/icon-02.png'),
                'titulo' => 'Herramientas concretas',
                'texto' => 'Cada sesión termina con claridad, reflexiones y pasos concretos. Combinamos conversación, visualizaciones, mapas mentales y dinámicas diseñadas para vos.',
                'orden' => 2,
            ],
            [
                'icono' => $this->publicar('assets/img/icon-03.png'),
                'titulo' => 'Espacio seguro',
                'texto' => 'Juntos creamos un espacio donde puedas sentirte cómodo, expresarte con libertad y poner en palabras lo que sentís, sin ser juzgado y con respeto por tu propio proceso.',
                'orden' => 3,
            ],
        ]);

        // -------------------------------------------------
        // Sesiones
        // -------------------------------------------------
        FormatoSesion::create([
            'insignia' => 'PROCESO',
            'titulo' => 'Proceso de Coaching',
            'parrafo_1' => 'Un acompañamiento abierto y sostenido, construido alrededor de lo que estás viviendo actualmente.',
            'parrafo_2' => 'Definimos un foco, lo vamos trabajando con continuidad y ajustamos el recorrido según lo que aparezca en el proceso.',
            'detalle' => 'Duración a convenir según el proceso.',
            'boton_texto' => 'Agendar Consulta',
            'boton_url' => 'https://calendar.app.google/yyE2dN7uzjg9H9TR9',
            'orden' => 1,
        ]);

        FormatoSesion::create([
            'insignia' => 'INDIVIDUAL',
            'titulo' => 'Sesión Individual',
            'parrafo_1' => 'Un encuentro único para trabajar un tema puntual. Puede servirte para tomar una decisión, resolver un conflicto, preparar una conversación, revisar una situación concreta o encontrar un próximo paso posible.',
            'parrafo_2' => null,
            'detalle' => 'Sesión de 60-90 minutos',
            'boton_texto' => 'Agendar Sesión',
            'boton_url' => 'https://calendar.app.google/yyE2dN7uzjg9H9TR9',
            'orden' => 2,
        ]);

        FormatoSesion::create([
            'insignia' => 'Pack x 4',
            'titulo' => 'Pack de 4 Sesiones',
            'parrafo_1' => 'Un recorrido estructurado sobre un tema específico. Elegís una propuesta de trabajo y la atravesamos en cuatro encuentros, con ejercicios, preguntas, herramientas y seguimiento entre sesiones.',
            'parrafo_2' => null,
            'detalle' => '4 Sesiones. Precio especial',
            'boton_texto' => 'Agendar Pack',
            'boton_url' => 'https://calendar.app.google/yyE2dN7uzjg9H9TR9',
            'orden' => 3,
        ]);

        // -------------------------------------------------
        // Temas
        // -------------------------------------------------
        Tema::create([
            'titulo' => 'Descubrí <br>tus valores',
            'texto' => 'Para identificar qué te importa de verdad, ordenar prioridades y tomar decisiones con más coherencia.',
            'orden' => 1,
        ]);

        Tema::create([
            'titulo' => 'Diseñá <br>tu visión',
            'texto' => 'Para construir una imagen clara de hacia dónde querés ir y transformarla en objetivos, acciones y un vision board.',
            'orden' => 2,
        ]);

        Tema::create([
            'titulo' => 'Diseñá una conversación importante',
            'texto' => 'Para preparar una conversación pendiente, ordenar lo que querés decir, cuidar el vínculo y llevarte un plan concreto para tenerla.',
            'orden' => 3,
        ]);

        Tema::create([
            'titulo' => 'Diseñá <br>tu ecosistema',
            'texto' => 'Un recorrido para mirar cómo está armado tu entorno actual (tus vínculos, hábitos, rutinas, espacios, límites y fuentes de energía). La idea es identificar qué necesitás mover para lograr lo que querés construir.',
            'orden' => 4,
        ]);

        Tema::create([
            'titulo' => 'Comunicación <br>y vínculos',
            'texto' => 'Para conocer estilos de comunicación, pedidos, acuerdos, límites y formas de relacionarte.',
            'orden' => 5,
        ]);

        Tema::create([
            'titulo' => 'Autoestima y confianza',
            'texto' => 'Esa voz que dice que no podés, que no sos suficiente, que te frena.',
            'orden' => 6,
        ]);

        // -------------------------------------------------
        // Herramientas
        // -------------------------------------------------
        $herramientas = [
            'Rueda de la vida',
            'Mapa de valores personales',
            'Ranking de valores',
            'Vision Board',
            'Diseño de metas con sentido',
            'Plan de acción',
            'Dinámicas de autoconocimiento',
            'Juegos de preguntas',
            'Visualizaciones',
            'Role playing de conversaciones',
            'Reflexiones escritas',
        ];

        foreach ($herramientas as $index => $nombre) {
            Herramienta::create(['nombre' => $nombre, 'orden' => $index + 1]);
        }

        // -------------------------------------------------
        // Ebooks
        // -------------------------------------------------
        Ebook::create([
            'imagen' => $this->publicar('assets/img/ebook-01.jpg'),
            'titulo' => 'Desafiá tus creencias limitantes',
            'texto' => 'Un recorrido práctico para identificar las historias que te frenan y reemplazarlas por nuevas posibilidades.',
            'pdf' => $this->publicar('assets/pdfs/desafia_tus_Creencias_Limitantes__Gabo_Patito.pdf'),
        ]);

        Ebook::create([
            'imagen' => $this->publicar('assets/img/ebook-02.jpg'),
            'titulo' => 'Máscaras y vulnerabilidad',
            'texto' => 'Explorá las máscaras que usás para protegerte y descubrí el poder de mostrarte auténtico.',
            'pdf' => $this->publicar('assets/pdfs/vulnerabilidad__Gabo_Patito.pdf'),
        ]);

        Ebook::create([
            'imagen' => $this->publicar('assets/img/ebook-03.jpg'),
            'titulo' => 'Valores: <br>El mapa invisible de tus decisiones',
            'texto' => 'Una guía para vivir en coherencia con lo que realmente sos. Identificá tus valores y tomá mejores decisiones.',
            'pdf' => $this->publicar('assets/pdfs/valores__Gabo_Patito.pdf'),
        ]);

        // -------------------------------------------------
        // Material gratuito
        // -------------------------------------------------
        Material::create([
            'imagen' => $this->publicar('assets/img/material-01.jpg'),
            'insignia' => 'GUÍA PDF',
            'titulo' => 'Rueda de la vida: <br>Chequeá en qué área estás',
            'texto' => 'Un ejercicio práctico para ver de un vistazo cómo estás en cada área de tu vida y dónde poner el foco.',
            'boton_url' => '#contacto',
        ]);

        Material::create([
            'imagen' => $this->publicar('assets/img/material-02.jpg'),
            'insignia' => 'AUDIO',
            'titulo' => 'Visualización guiada: <br>Conectá con tu mejor versión',
            'texto' => 'Una visualización de 10 minutos para conectar con tu potencial y clarificar qué querés.',
            'boton_url' => '#contacto',
        ]);

        Material::create([
            'imagen' => $this->publicar('assets/img/material-03.jpg'),
            'insignia' => 'EJERCICIO',
            'titulo' => 'Mapa de valores: ¿Qué es lo que realmente te importa?',
            'texto' => 'Un ejercicio de reflexión para identificar tus valores más profundos y vivir con mayor coherencia.',
            'boton_url' => '#contacto',
        ]);

        // -------------------------------------------------
        // Cursos
        // -------------------------------------------------
        Curso::create([
            'titulo' => 'Comunicación asertiva: Hablá desde quien sos',
            'texto' => 'Aprendé a expresarte con claridad, hacer pedidos efectivos y poner límites sin culpa.',
            'orden' => 1,
        ]);

        Curso::create([
            'titulo' => 'Autoconocimiento:  El viaje hacia adentro',
            'texto' => 'Un curso completo para explorar tu identidad, emociones y los patrones que te definen.',
            'orden' => 2,
        ]);

        Curso::create([
            'titulo' => 'Diseñá tu proyecto personal',
            'texto' => 'De la idea a la acción. Definí tu visión, encontrá tu propósito y construí un plan real.',
            'orden' => 3,
        ]);

        Curso::create([
            'titulo' => 'Desafiá tus creencias: pensá diferente',
            'texto' => 'Identificá las creencias que te limitan y aprendé a transformarlas en recursos.',
            'orden' => 4,
        ]);

        // -------------------------------------------------
        // Talleres
        // -------------------------------------------------
        Taller::create([
            'estado' => 'inscripciones_abiertas',
            'titulo' => 'Descubrí tus valores',
            'texto' => 'Tres encuentros en vivo para explorar tu mapa de valores y tomar decisiones más coherentes.',
            'boton_texto' => 'Inscribirme Ahora',
            'boton_url' => '#contacto',
            'orden' => 1,
        ]);

        Taller::create([
            'estado' => 'proximamente',
            'titulo' => 'Comunicación que conecta',
            'texto' => 'Tres encuentros en vivo para entrenar tu forma de comunicarte, practicar conversaciones difíciles y construir vínculos más sanos.',
            'boton_texto' => 'Pronto',
            'boton_url' => '#contacto',
            'orden' => 2,
        ]);

        Taller::create([
            'estado' => 'proximamente',
            'titulo' => 'Rueda de la vida: <br>Un diagnóstico honesto',
            'texto' => 'Un taller para hacer un balance real de tu vida y definir hacia dónde querés ir.',
            'boton_texto' => 'Pronto',
            'boton_url' => '#contacto',
            'orden' => 3,
        ]);

        // -------------------------------------------------
        // Testimonios
        // -------------------------------------------------
        Testimonio::create([
            'frase' => '"Me encanta la atención de Gabriel en todo lo que le pasa uno para hacer la pregunta necesaria para poder reflexionar."',
            'nombre' => 'Raúl',
            'formato' => 'Proceso de Coaching',
            'orden' => 1,
        ]);

        Testimonio::create([
            'frase' => '"Durante el proceso me sentí muy acompañada y escuchada, me ayudó a verme más a mi misma y a enfocar mi energía en mi"',
            'nombre' => 'Miriam',
            'formato' => 'Proceso de Coaching',
            'orden' => 2,
        ]);

        Testimonio::create([
            'frase' => '"Muchas gracias Gabo por tu acompañamiento, muy conforme gracias🌱"',
            'nombre' => 'Rita',
            'formato' => 'Proceso de Coaching',
            'orden' => 3,
        ]);

        // -------------------------------------------------
        // FAQ
        // -------------------------------------------------
        Faq::create([
            'pregunta' => '¿Qué es el coaching?',
            'respuesta' => 'El coaching es un proceso de acompañamiento que te ayuda a identificar lo que querés, entender qué te frena y encontrar tus propios recursos para avanzar. No es terapia ni consultoría: el coach no da respuestas, sino que hace las preguntas que te ayudan a encontrarlas vos.',
            'orden' => 1,
        ]);

        Faq::create([
            'pregunta' => '¿Para quién es el coaching?',
            'respuesta' => 'Para cualquier persona que quiera hacer un cambio en su vida, tomar decisiones con más claridad, mejorar sus vínculos o simplemente conocerse mejor. No es necesario estar en crisis: muchas personas trabajan con un coach en momentos de crecimiento.',
            'orden' => 2,
        ]);

        Faq::create([
            'pregunta' => '¿Qué requisitos hay para empezar?',
            'respuesta' => 'Solo necesitás ganas de explorar y un tema sobre el que quieras trabajar. No hace falta tener todo claro: muchas veces la primera sesión sirve para justamente ordenar lo que sentís y definir por dónde empezar.',
            'orden' => 3,
        ]);

        Faq::create([
            'pregunta' => '¿Cómo son las sesiones?',
            'respuesta' => 'Las sesiones son conversaciones profundas y estructuradas. Arrancamos desde lo que vos traés, trabajamos con herramientas específicas según el tema, y terminamos con reflexiones concretas o pasos de acción. El ritmo lo marcás vos.',
            'orden' => 4,
        ]);

        Faq::create([
            'pregunta' => '¿Cuánto duran las sesiones?',
            'respuesta' => 'Las sesiones duran entre 60 y 90 minutos. Dependiendo del tema y el formato elegido, podemos ajustar el tiempo para que se adapte a lo que necesitás.',
            'orden' => 5,
        ]);

        Faq::create([
            'pregunta' => '¿Qué temas NO se pueden trabajar?',
            'respuesta' => 'El coaching no trabaja trastornos de salud mental, adicciones ni situaciones que requieran atención clínica. En esos casos, lo más responsable es derivar a un profesional de la salud. Siempre lo vamos a consultar juntos.',
            'orden' => 6,
        ]);

        Faq::create([
            'pregunta' => '¿Es lo mismo que terapia?',
            'respuesta' => 'No. La terapia trabaja sobre el pasado y la psicopatología. El coaching trabaja desde el presente hacia el futuro, con foco en el potencial y los recursos de la persona. Pueden complementarse, pero son disciplinas distintas.',
            'orden' => 7,
        ]);

        Faq::create([
            'pregunta' => '¿Las sesiones son online?',
            'respuesta' => 'Sí, todas las sesiones son online vía videollamada. Esto permite trabajar con personas de cualquier parte del mundo, con la comodidad de hacerlo desde tu propio espacio.',
            'orden' => 8,
        ]);

        Faq::create([
            'pregunta' => '¿Cuántas sesiones necesito?',
            'respuesta' => 'Depende del tema y de lo que quieras lograr. Para una decisión puntual puede alcanzar una sesión. Para un proceso de autoconocimiento más profundo, el pack de 4 sesiones suele ser un buen punto de partida. Lo definimos juntos en la primera sesión.',
            'orden' => 9,
        ]);

        Faq::create([
            'pregunta' => '¿Las sesiones son confidenciales?',
            'respuesta' => 'Absolutamente. Todo lo que se habla en una sesión es estrictamente confidencial. El espacio de coaching es un lugar seguro donde podés ser completamente honesto sin temor a juicios.',
            'orden' => 10,
        ]);

        Faq::create([
            'pregunta' => '¿Qué te podés llevar de una sesión?',
            'respuesta' => '•	Una mirada más clara sobre lo que te pasa <br>•	Preguntas que te ayuden a ver opciones nuevas <br>•	Ejercicios concretos para seguir trabajando en tu transformación <br>•	Un próximo paso posible y realista <br>•	Mayor claridad para decidir, conversar o accionar <br>•	Un registro escrito o mapa de lo trabajado <br>•	Autoconocimiento',
            'orden' => 11,
        ]);

        Faq::create([
            'pregunta' => '¿Cómo funciona el proceso?',
            'respuesta' => '<strong>1. Agendás una primera consulta</strong><br>Nos conocemos, me contás qué estás buscando y vemos si este espacio tiene sentido para vos.<br><strong>2. Definimos un foco de trabajo</strong><br>En la primera entrevista podemos definir cuál va a ser el foco del proceso en el que iremos trabajando sesión tras sesión.<br><strong>3. Trabajamos en sesión</strong><br>Conversamos, exploramos, usamos herramientas y diseñamos próximos pasos. En cada sesión, la idea es que puedas llevarte un plan de acción.<br><strong>4. Revisamos avances</strong><br>Vemos qué funcionó, qué apareció y qué conviene ajustar.<br><strong>5. Cierre de proceso</strong><br>Una vez que llegamos al final de nuestros encuentros, cerramos el proceso con un feedback sobre lo trabajado.',
            'orden' => 12,
        ]);

        // -------------------------------------------------
        // Configuración general
        // -------------------------------------------------
        Configuracion::create([
            'mostrar_ebooks' => false,
        ]);

        // -------------------------------------------------
        // Contacto / datos globales
        // -------------------------------------------------
        Contacto::create([
            'email' => 'hola@espaciotransformarte.com',
            'whatsapp' => '5491149274026',
            'calendly_url' => 'https://calendar.app.google/yyE2dN7uzjg9H9TR9',
            'instagram_url' => 'https://www.instagram.com/espacio_transformarte/',
        ]);

        // -------------------------------------------------
        // Página de gracias
        // -------------------------------------------------
        Gracias::create([
            'insignia' => 'MENSAJE RECIBIDO',
            'titulo' => 'Gracias por <em>tu mensaje</em>',
            'texto' => 'Tu consulta fue recibida correctamente. Será revisada y respondida dentro de las próximas 24 a 48 horas hábiles al correo electrónico que indicaste.',
            'texto_urgencia' => 'Si tu solicitud requiere una respuesta con mayor urgencia, podés escribir directamente por WhatsApp.',
            'boton_whatsapp_texto' => 'Escribir por WhatsApp',
        ]);
    }

    /**
     * Copia un asset de public/ al disco público de storage
     * para que pueda editarse desde el panel (FileUpload).
     */
    private function publicar(string $path): string
    {
        $destino = 'uploads/'.basename(dirname($path)).'/'.basename($path);
        $origen = public_path($path);
        $target = storage_path('app/public/'.$destino);

        if (is_file($origen) && ! is_file($target)) {
            if (! is_dir(dirname($target))) {
                mkdir(dirname($target), 0755, true);
            }
            copy($origen, $target);
        }

        return $destino;
    }
}
