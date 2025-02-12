<?php

namespace Fuelviews\SabHeroBlog\Mails;

use Fuelviews\SabHeroBlog\Exceptions\CannotSendEmail;
use Fuelviews\SabHeroBlog\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BlogPublished extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(private Post $post, private string $toEamil = '')
    {
    }

    public function envelope(): Envelope
    {
        if ($this->post->isNotPublished()) {
            throw CannotSendEmail::postNotPublished();
        }

        return new Envelope(
            to: $this->toEamil,
            subject: 'New Purchase Mail'
        );

    }

    public function content(): Content
    {
        return new Content(
            view: 'filament-blog::mails.blog-published',
            with: ['post' => $this->post]
        );
    }
}
