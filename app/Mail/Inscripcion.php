<?php

namespace App\Mail;

use App\Models\Carreras;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Inscripcion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $student;
    public $inscrip;

    public function __construct($student, $inscrip)
    {
        $this->student = $student;
        $this->inscrip = $inscrip;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $carrera = Carreras::where('id', $this->inscrip->carrera_id)->first();
        return new Envelope(
            subject: 'Inscripcion En El Sistema De La UPTTMBI PNF ' . $carrera->carrera,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.Inscripcion',
            with: [
                'student'=>$this->student,
                'inscript'=>$this->inscrip,
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
        return [];
    }
}
