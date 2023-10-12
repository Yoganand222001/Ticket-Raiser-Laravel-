<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketRaised extends Mailable
{
    use Queueable, SerializesModels;
    protected string $user_name ;

    protected string $url ;
    public function __construct(string $user_name, string $url)
    {
        $this->user_name = $user_name;

        $this->url = $url;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Ticket Raised by'.' '. $this->user_name,
        );
    }

    public function content()
    {
        return new Content(
            markdown: 'emails.ticketsraised',
            with: [
                'ticket_url' => $this->url
            ]
        );
    }


}
