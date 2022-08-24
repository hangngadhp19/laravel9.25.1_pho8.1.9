<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\EmailClient;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send(Request $request, $modelName, $id){
    	$adminUser = Auth::guard('admin')->user();

    	$model = '\App\Models\\'.ucfirst($modelName);
    	$model_data = $model::where('id', $id)->first();
	
	$mailData = [
		"lastname" => $model_data->lastname,
		"firstname" => $model_data->firstname,
		"id" => $model_data->id,
		"status_devis" => $model_data->status_devis
	    ];

    	//Mail::to($model_data->email)->send(new EmailClient($mailData, $adminUser));

	return view('email.client', [
        	'user'=>$adminUser,
        	'data'=>$mailData
        ]);
    }

    public function update(Request $request, $modelName, $id, $status){

	$adminUser = Auth::guard('admin')->user();

	$model = "App\Models\\".ucfirst($modelName);
	$model_name = $model::where('id', $id)->first();

	$model_name->status_devis = $status;

	$status_save = $model_name->update();

	//Mail::to($adminUser->email)->send(new EmailClient($model_name, $adminUser));

	return redirect()->route('listing.index', ['model' => $modelName]);
    }

    
}
