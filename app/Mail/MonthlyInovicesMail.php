<?php

namespace App\Mail;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MonthlyInovicesMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $files;
    public User $user;
    public string $code;

    /**
     * Create a new message instance.
     */
    public function __construct($files,$user)
    {
        $this->files = $files;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Monthly Invoices Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.monthly',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];
        $i = 1;
        foreach ($this->files as $file){
            $tmpFile =  PDF::loadView('invoice', ['data' => $file]);
            $attachments[] =  Attachment::fromData(fn () => $tmpFile->output(), "invoice-$i.pdf")
                ->withMime('application/pdf');
            $i++;
        }

        return $attachments;
    }
}
