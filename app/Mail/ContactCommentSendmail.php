<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactCommentSendmail extends Mailable
{
    use Queueable, SerializesModels;

    private $title;
    private $name;
    private $email;
    private $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contact)
    {
        $this->title = $contact['title'];
        $this->name = $contact['name'];
        $this->email = $contact['email'];
        $this->contact = $contact['contact'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->email)
            ->subject('お問い合わせがありました')
            ->view('mailcomment')
            ->with([
                'title' => $this->title,
                'name' => $this->name,
                'email' => $this->email,
                'contact' => $this->contact,
            ]);
    }
}
