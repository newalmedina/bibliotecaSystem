<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Configuration;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->data["tipo"] == "devolucion") {
            return $this->view('mail.devuelta')
                ->from($this->data["configuracion"]->correo)
                ->subject($this->data["subject"]);
        }

        return $this->view('mail.prestamo')
            ->from($this->data["configuracion"]->correo)
            ->subject($this->data["subject"]);
    }
}
