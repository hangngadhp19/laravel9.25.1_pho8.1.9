<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditingController extends Controller
{
	public function create(Request $request, $modelName){
		$adminUser = Auth::guard('admin')->user();

	    	$model = '\App\Models\\'.ucfirst($modelName);
	    	$model = new $model;

		return view('admin.editing', [
			'modelName'=>$modelName,
		        'user'=>$adminUser
        	]);
	}

	public function store(Request $request, $modelName){

		$adminUser = Auth::guard('admin')->user();

	    	$model = "App\Models\\".ucfirst($modelName);
	    	$model_name = new $model;

		$arrValidateFields = [
			'lastname' => 'required|max:150',
			'firstname' => 'required|max:150',
			'email' => 'required|unique:clients',
			'tel' => 'required|max:15',
			'adress' => 'required'
		    ];

		$validated = $request->validate($arrValidateFields);

		$model_name->lastname = $request->input("lastname");
		$model_name->firstname = $request->input("firstname");
		$model_name->email = $request->input("email");
		$model_name->tel = $request->input("tel");
		$model_name->adress = $request->input("adress");
		$model_name->status_devis = 0;

		$status_save = $model_name->save();

		return view('admin.editing', [
        	'success'=>$status_save,
			'user'=>$adminUser
        	]);
		
	}

	public function update(Request $request, $modelName, $id){

		$adminUser = Auth::guard('admin')->user();

	    	$model = "App\Models\\".ucfirst($modelName);
	    	$model_name = $model::where('id', $id)->first();

		$arrValidateFields = [
			'lastname' => 'required|max:150',
			'firstname' => 'required|max:150',
			'email' => 'required',
			'tel' => 'required|max:15',
			'adress' => 'required'
		    ];

		$validated = $request->validate($arrValidateFields);

		$model_name->lastname = $request->input("lastname");
		$model_name->firstname = $request->input("firstname");
		$model_name->email = $request->input("email");
		$model_name->tel = $request->input("tel");
		$model_name->adress = $request->input("adress");
		$model_name->status_devis = 0;

		$status_save = $model_name->update();

		return view('admin.editing', [
        	'success'=>$status_save,
			'user'=>$adminUser
        	]);
		
	}

	public function edit(Request $request, $modelName, $id){
		$adminUser = Auth::guard('admin')->user();

	    	$model = "App\Models\\".ucfirst($modelName);
	    	$model_data = $model::where('id', $id)->first();

	    	return view('admin.show', [
			'model_data'=>$model_data,
				'user'=>$adminUser
		]);
	}

	public function destroy(Request $request, $modelName, $id){
		$adminUser = Auth::guard('admin')->user();

	    	$model = "App\Models\\".ucfirst($modelName);
	    	$model_name = $model::destroy($id);


	    	return redirect()->route('listing.index', ['model' => $modelName]);
	}


}
