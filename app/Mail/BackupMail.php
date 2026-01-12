<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BackupMail extends Mailable
{
    use Queueable, SerializesModels;

    public $compressedSql;

    /**
     * Create a new message instance.
     */
    public function __construct($compressedSql)
    {
        $this->compressedSql = $compressedSql;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Respaldo Del Sistema Universitario UPTT - ReadyGrades',
            tags: ['Respaldo', 'Backup', 'Copia de Seguridad'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.backup',
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
            Attachment::fromData(fn () => $this->compressedSql, "respaldo-UPTT-" . now()->format('d-m-Y') . ".gz")
                ->withMime('application/x-gzip'),
        ];
    }
}
