<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisClient extends Model
{
    use HasFactory;

    protected $table = "devis_client";

    protected $fillable = [
    	'id_devis',
    	'id_client',
	'status_devis',
    ];
}
