<?php

namespace App\Mail;

use App\Models\BioCode\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BioCodeMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $el;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $el)
    {
        $this->el = $el;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('biocodeMail');
    }
}
