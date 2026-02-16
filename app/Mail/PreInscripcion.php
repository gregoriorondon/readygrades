<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PreInscripcion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     */
    public $pdfOup;
    public $filename;
    public $r;
    public $genero;

    public function __construct($pdfOup, $filename, $r, $genero)
    {
        $this->pdfOup = $pdfOup;
        $this->filename = $filename;
        $this->r = $r;
        $this->genero = $genero;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        if ($this->genero === 'masculino') {
            return new Envelope(
                subject: '¡Bienvenido a la UTTMBI!... Proximos pasos para completar tu pre-inscripción.',
            );
        } else {
            return new Envelope(
                subject: '¡Bienvenida a la UTTMBI!... Proximos pasos para completar tu pre-inscripción.',
            );
        }

    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.preinscripcion',
            with: [
                'genero'=>$this->genero,
                'r'=>$this->r,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfOup, $this->filename)
                ->withMime('application/pdf'),
        ];
    }
}
