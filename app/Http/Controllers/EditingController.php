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

		if (ucfirst($modelName) == 'Client'){
		    $template_name = "admin.editing";
		} elseif (ucfirst($modelName) == 'Product'){
		    $template_name = "admin.add_pro";
		} elseif (ucfirst($modelName) == 'Devis'){
		    $template_name = "admin.add_devis";
		}

		return view($template_name, [
			'modelName'=>$modelName,
		        'user'=>$adminUser
        	]);
	}

	public function store(Request $request, $modelName){

		$adminUser = Auth::guard('admin')->user();

	    	$model = "App\Models\\".ucfirst($modelName);
	    	$model_name = new $model;

		if (ucfirst($modelName) == 'Client'){
			$arrValidateFields = [
				'lastname' => 'required|max:150',
				'firstname' => 'required|max:150',
				'email' => 'required|unique:clients',
				'tel' => 'required|max:15',
				'adress' => 'required'
			    ];
		} elseif (ucfirst($modelName) == 'Product'){
			$arrValidateFields = [
				'name' => 'required',
				'des' => 'required',
				'price' => 'required|integer'
			    ];
		} elseif (ucfirst($modelName) == 'Devis'){
			$arrValidateFields = [
				'name' => 'required',
				'des' => 'required'
			    ];
		}


		$validated = $request->validate($arrValidateFields);

		if (ucfirst($modelName) == 'Client'){
			$model_name->lastname = $request->input("lastname");
			$model_name->firstname = $request->input("firstname");
			$model_name->email = $request->input("email");
			$model_name->tel = $request->input("tel");
			$model_name->adress = $request->input("adress");
		} elseif (ucfirst($modelName) == 'Product'){
			$model_name->name = $request->input("name");
			$model_name->des = $request->input("des");
			$model_name->price = $request->input("price");
		} elseif (ucfirst($modelName) == 'Devis'){
			$model_name->name = $request->input("name");
			$model_name->des = $request->input("des");
		}


		$status_save = $model_name->save();

		return view('admin.editing', [
        		'success'=>$status_save,
			'modelName'=>ucfirst($modelName),
			'user'=>$adminUser
        	]);
		
	}

	public function update(Request $request, $modelName, $id){

		$adminUser = Auth::guard('admin')->user();

	    	$model = "App\Models\\".ucfirst($modelName);
	    	$model_name = $model::where('id', $id)->first();

		if (ucfirst($modelName) == 'Client'){
			$arrValidateFields = [
				'lastname' => 'required|max:150',
				'firstname' => 'required|max:150',
				'email' => 'required',
				'tel' => 'required|max:15',
				'adress' => 'required'
			    ];
		} elseif (ucfirst($modelName) == 'Product'){
			$arrValidateFields = [
				'name' => 'required',
				'des' => 'required',
				'price' => 'required|integer'
			    ];
		} elseif (ucfirst($modelName) == 'Devis'){
			$arrValidateFields = [
				'name' => 'required',
				'des' => 'required'
			    ];
		}


		$validated = $request->validate($arrValidateFields);

		if (ucfirst($modelName) == 'Client'){
			$model_name->lastname = $request->input("lastname");
			$model_name->firstname = $request->input("firstname");
			$model_name->email = $request->input("email");
			$model_name->tel = $request->input("tel");
			$model_name->adress = $request->input("adress");
		} elseif (ucfirst($modelName) == 'Product'){
			$model_name->name = $request->input("name");
			$model_name->des = $request->input("des");
			$model_name->price = $request->input("price");
		} elseif (ucfirst($modelName) == 'Devis'){
			$model_name->name = $request->input("name");
			$model_name->des = $request->input("des");
		}


		$status_save = $model_name->update();

		return view('admin.editing', [
        		'success'=>$status_save,
			'modelName'=>ucfirst($modelName),
			'user'=>$adminUser
        	]);
		
	}

	public function edit(Request $request, $modelName, $id){
		$adminUser = Auth::guard('admin')->user();

	    	$model = "App\Models\\".ucfirst($modelName);
	    	$model_data = $model::where('id', $id)->first();

		if (ucfirst($modelName) == 'Client'){
		    $template_name = "admin.show";
		} elseif (ucfirst($modelName) == 'Product'){
		    $template_name = "admin.show_pro";
		} elseif (ucfirst($modelName) == 'Devis'){
		    $template_name = "admin.show_devis";
		}

	    	return view($template_name, [
			'model_data'=>$model_data,
			'modelName'=>ucfirst($modelName),
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
