<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class mail extends Mailable
{
    use Queueable, SerializesModels;
    public $views;
    public $ticket_no;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($views,$ticket_no)
    {
        $this->view = $views;
        $this->ticket_no = $ticket_no;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view = $this->view;
        $ticket_no= $this->ticket_no;
        return $this->view('auth.customer.ticket',compact('view','ticket_no'));
    }
}

?>