<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrapCatchMail extends Mailable
{
    use Queueable, SerializesModels;

    public Object $trap;

    public Object $user;

    public String $time;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($trap, $user, $time)
    {
        $this->trap = $trap;
        $this->user = $user;
        $this->time = $time;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->replyTo('admin@trappy.com')
            ->subject('Trappy notification')
            ->view('mail.trapcatch');
    }
}
