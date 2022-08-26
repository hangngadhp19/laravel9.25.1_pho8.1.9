<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DevisPro extends Model
{
    use HasFactory;
    protected $table = "devis_pro";

    protected $fillable = [
    	'id_devis',
    	'id_pro',
    ];
}
