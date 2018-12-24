<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class pendingMail extends Mailable
{
    use Queueable, SerializesModels;
    public $video;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($video)
    {
        $this->video = $video;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@mouthpiece.com')
                    ->markdown('emails.pendingVideo');
    }
}
