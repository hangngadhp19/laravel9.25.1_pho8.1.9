<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class PdfEmailClient extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $id_devis;
    public $pdf;

   /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id_devis, $pdf)
    {
	$this->id_devis = $id_devis;
	$this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

	return $this->subject('Facture')
			->attach(Storage::path('facture_'.$this->id_devis.'.pdf'), [
		            'as' => 'facture_'.$this->id_devis.'.pdf',
		            'mime' => 'application/pdf',
		        ])

			->view('email.client_devis');


    }
}
