<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DevisClient;
use App\Models\Devis;

class ListingController extends Controller
{
    public function index(Request $request, $modelName){
    	$adminUser = Auth::guard('admin')->user();

    	$model = '\App\Models\\'.ucfirst($modelName);
    	$records = $model::paginate(3);

	if (ucfirst($modelName) == 'Client'){
	    $template_name = "admin.listing";
	} elseif (ucfirst($modelName) == 'Product'){
	    $template_name = "admin.lst_pro";
	} elseif (ucfirst($modelName) == 'Devis'){
	    $template_name = "admin.lst_devis";
	}

	foreach($records as $key=>$obj){

		$model_devis_client = new DevisCLient();
		$data_devis_client = $model_devis_client->where("id_client", $obj->id)->where("status_devis", 1)->get();
		
		$arr_devis_name[$key] = array();
		foreach ($data_devis_client as $data) {
			$id_devis = !empty($data)  ? $data->id_devis : 0;

			if ($id_devis > 0) {
				$model_devis = new Devis();
				$data_devis = $model_devis->where("id", $id_devis)->first();
				$arr_devis_name[$key][] = !empty($data_devis->name) ? $data_devis->name : '';
			}
		}
		$records[$key]->name_devis = '';
		if (count($arr_devis_name[$key]) > 0) {
			$records[$key]->name_devis = implode(", ", $arr_devis_name[$key]);
		}
	}

        return view($template_name, [
        	'user'=>$adminUser,
		'modelName'=>ucfirst($modelName),
        	'records'=>$records
        ]);
    }
}
