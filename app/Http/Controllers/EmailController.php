<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\EmailClient;
use Illuminate\Support\Facades\Mail;
use App\Models\Client;
use App\Models\DevisClient;

class EmailController extends Controller
{
    public function send(Request $request, $id_devis){
    	$adminUser = Auth::guard('admin')->user();

    	$model_client = new Client();
    	$model_data = $model_client->all();

	$mailData = [
		"lastname" => $model_data[0]->lastname,
		"firstname" => $model_data[0]->firstname,
		"id" => $model_data[0]->id,
	    ];

    	//Mail::to($model_data->email)->send(new EmailClient($mailData, $adminUser));

	return view('email.client', [
        	'user'=>$adminUser,
		'id_devis'=>$id_devis,
        	'data'=>$mailData
        ]);
    }

    public function update(Request $request, $id_devis, $id_client, $status){

	$adminUser = Auth::guard('admin')->user();

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

	//Mail::to($adminUser->email)->send(new EmailClient($data, $adminUser));

	return redirect()->route('listing.index', ['model' => 'Devis']);
    }

    
}
