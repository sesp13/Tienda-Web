<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmUserMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Confirmación de cuenta";

    //Contenido del correo pasado a la vista
    public $msg;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.confirm', [
            'msg' => $this->msg,
        ]);
    }
}
