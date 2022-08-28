<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class AdminEmailClient extends Mailable
{
    use Queueable, SerializesModels;
    public $data_client;
    public $name_devis;
    public $status;

   /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_client, $name_devis, $status)
    {
        $this->data_client = $data_client;
	$this->name_devis = $name_devis;
	$this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
	return $this->subject('Choix du client')
			->view('email.choise_client');

    }
}
