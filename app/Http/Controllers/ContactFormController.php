<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactoRequest;
use App\Mail\NuevoMensajeContacto;
use App\Models\Contacto;
use App\Models\Mensaje;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    /**
     * Procesa el formulario de contacto: guarda el mensaje en la base
     * (visible en el panel de administración) y además lo envía por mail
     * si hay un mailer configurado.
     */
    public function store(ContactoRequest $request): RedirectResponse
    {
        $mensaje = Mensaje::create([
            'nombre' => $request->string('nombre')->trim()->value(),
            'apellido' => $request->string('apellido')->trim()->value(),
            'email' => $request->string('email')->trim()->lower()->value(),
            'telefono' => $request->string('telefono')->trim()->value() ?: null,
            'sesion' => $request->string('sesion')->value(),
            'mensaje' => $request->string('mensaje')->trim()->value(),
            'ip' => $request->ip(),
        ]);

        // El envío por mail no debe romper la experiencia si falla:
        // el mensaje ya quedó guardado y visible en el panel.
        try {
            $destino = Contacto::first()?->email ?: config('mail.from.address');
            Mail::to($destino)->send(new NuevoMensajeContacto($mensaje));
        } catch (\Throwable $e) {
            Log::error('No se pudo enviar el mail del formulario de contacto.', [
                'mensaje_id' => $mensaje->id,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect('/gracias');
    }
}
