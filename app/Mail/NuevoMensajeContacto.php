<?php

namespace App\Mail;

use App\Models\Mensaje;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NuevoMensajeContacto extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Mensaje $mensaje,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nuevo mensaje de la web Espacio Transformarte',
            replyTo: [
                new Address($this->mensaje->email, $this->mensaje->nombre.' '.$this->mensaje->apellido),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contacto',
        );
    }
}
