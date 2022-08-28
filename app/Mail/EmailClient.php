<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class EmailClient extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $user;
    public $id_devis;

   /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $id_devis)
    {
        $this->data = $data;
	$this->id_devis = $id_devis;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
	return $this->subject('Un devis')
			->attach(Storage::path('devis_'.$this->id_devis.'.pdf'), [
		            'as' => 'devis_'.$this->id_devis.'.pdf',
		            'mime' => 'application/pdf',
		        ])

			->view('email.client');

    }
}
