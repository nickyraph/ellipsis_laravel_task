<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LinkExpiredMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $username;

    public $link;

    public function __construct($username, $link)
    {
        $this->username = $username;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Mail/LinkExpiredMail')
                    ->subject('Short URL Expired!')
                    ->with([
                        'username' => $this->username,
                        'link' => $this->link,
                    ]);
    }
}
