<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sujip\Filament\Turnstile\Rules\TurnstileRule;

class ContactoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación del formulario de contacto.
     * El campo "empresa" es un honeypot: si viene con contenido, es un bot.
     * El campo "cf-turnstile-response" valida el token del captcha de Cloudflare.
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:150'],
            'telefono' => ['nullable', 'string', 'max:40'],
            'sesion' => ['required', 'in:Proceso de Coaching,Sesión Individual,Pack de 4 Sesiones'],
            'mensaje' => ['required', 'string', 'max:3000'],
            'empresa' => ['prohibited'],
            'cf-turnstile-response' => [
                'required',
                new TurnstileRule,
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'Ingresá tu nombre.',
            'apellido.required' => 'Ingresá tu apellido.',
            'email.required' => 'Ingresá tu email.',
            'email.email' => 'El email no es válido.',
            'sesion.required' => 'Elegí en qué te interesa trabajar.',
            'sesion.in' => 'Elegí una opción válida.',
            'mensaje.required' => 'Escribí tu mensaje.',
            'mensaje.max' => 'El mensaje es demasiado largo.',
            'cf-turnstile-response.required' => 'Por favor, completá la verificación de seguridad.',
        ];
    }
}
