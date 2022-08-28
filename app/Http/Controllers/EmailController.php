<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\EmailClient;
use App\Mail\AdminEmailClient;
use App\Mail\PdfEmailClient;
use Illuminate\Support\Facades\Mail;
use App\Models\Client;
use App\Models\Product;
use App\Models\DevisClient;
use App\Models\DevisPro;
use App\Models\Devis;
use App\Models\Admin;
use PDF;

class EmailController extends Controller
{
    public function send(Request $request, $id_devis){
    	$adminUser = Auth::guard('admin')->user();

    	$model_client = new Client();
    	$model_datas = $model_client->all();

	foreach ($model_datas as $key=>$model_data) {
		$mailData = [
			"lastname" => $model_data->lastname,
			"firstname" => $model_data->firstname,
			"id" => $model_data->id,
		    ];


		$to_email = $model_data->email;

		// begin pdf
		$arr_pro = $this->returnArrPro($id_devis);

		$pdfFilePath = base_path('storage/app/devis_'.$id_devis.'.pdf');


		$pdf = PDF::loadView('email.pdf', $arr_pro, [], [
		  'title' => 'Another Title',
		  'margin_top' => 0
		])->save($pdfFilePath);
		// end pdf

		Mail::to($to_email)->send(new EmailClient($mailData, $id_devis));
		if (Mail::flushMacros()) {
		   $result = 'Pardon! Veuillez réessayer plus tard';
		}else{
		   $result = 'Super! Envoyez votre courrier avec succès';
		}
	}

	return view('email.success', [
        	'user'=>$adminUser,
		'result'=>$result
        ]);
    }

    public function update(Request $request, $id_devis, $id_client, $status){

	$model_devis_client = new DevisClient();
	$data = $model_devis_client->where('id_devis', $id_devis)->where('id_client', $id_client)->first();
	
	if ( ! empty($data)) {
		$data->status_devis = $status;
		$data->update();
	} else {
		$data = new DevisClient();
		$data->id_devis = $id_devis;
		$data->id_client = $id_client;
		$data->status_devis = $status;
		$data->save();
	}

	// get email client
	$model_client = new Client();
	$data_client = $model_client->where('id', $id_client)->first();
	// end email client

	if ($status == 1) {
		$arr_pro = $this->returnArrPro($id_devis);

		$pdfFilePath = base_path('storage/app/facture_'.$id_devis.'.pdf');


		$pdf = PDF::loadView('email.pdf_facture', $arr_pro, [], [
		  'title' => 'Facture',
		  'margin_top' => 0
		])->save($pdfFilePath);

		$to_email = $data_client->email;
		Mail::to($to_email)->send(new PdfEmailClient($id_devis, $pdf));
		$result ="Un facture par mail vous a été envoyé";
	 } else {
		$result = "J'espère vous envoyer un facture pour la prochaine fois.";
	}

	$this->sendMailToAdmin($data_client, $id_devis, $status);
	
	return view('action_email', [
        	'result_action'=>$result
        ]);
    }

    public function returnArrPro($id_devis){
	// get all products
	$model_devis_pro = new DevisPro();
	$datas_devis_pro = $model_devis_pro->where('id_devis', $id_devis)->get();
	// end get all products

	// get a product
	$arr_pro = array();
	$sum = 0;
	foreach($datas_devis_pro as $data_devis_pro) {
		$model_pro = new Product();
		$data_pro = $model_pro->where('id', $data_devis_pro->id_pro)->first();
		
		$arr_pro['name'][$data_pro->id] = $data_pro->name;
		$arr_pro['price'][$data_pro->id] = $data_pro->price;
	}
	// end a product
	return $arr_pro;
    }

    public function sendMailToAdmin($data_client, $id_devis, $status){
	$m_devis = new Devis();
	$data_devis = $m_devis->where('id', $id_devis)->first();

	$m_admin = new Admin();
	$data_admin = $m_admin->where('id', 1)->first();

	$email_admin = $data_admin->email;
	Mail::to($email_admin)->send(new AdminEmailClient($data_client, $data_devis->name, $status));
    }

    
}
