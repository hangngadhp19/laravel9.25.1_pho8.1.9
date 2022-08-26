<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DevisPro;
use App\Models\DevisClient;

class DevisController extends Controller
{
    public function create(Request $request, $id_devis){
	$adminUser = Auth::guard('admin')->user();

    	$model = '\App\Models\Product';
    	$records = $model::paginate(50);

	$model_devis_pro = new DevisPro();
	$data_devis_pro = $model_devis_pro->where('id_devis', $id_devis)->get();

	$arr_id_pro_choise = array();
	foreach($data_devis_pro as $obj){
	    $arr_id_pro_choise[$obj->id_pro] = $obj->id_pro;
	}
	
        return view("admin.add_pro_devis", [
        	'user'=>$adminUser,
		'id_devis'=>$id_devis,
		'arr_id_pro_choise'=>$arr_id_pro_choise,
        	'records'=>$records
        ]);
    }

    public function store(Request $request, $id_devis){

	$adminUser = Auth::guard('admin')->user();

	$model = "App\Models\DevisPro";
	$model_name = $model::where('id_devis', $id_devis)->delete();
    	if (is_array($request->input("id_pro")) && count($request->input("id_pro")) > 0) {
		foreach($request->input("id_pro") as $id_pro){
		    $devis_pro = new DevisPro();
		    $devis_pro->id_devis = $id_devis;
		    $devis_pro->id_pro = $id_pro;
		    $devis_pro->save();		
		}
	}

	return redirect()->route('listing.index', ['model' => 'Devis']);
		
    }
}
