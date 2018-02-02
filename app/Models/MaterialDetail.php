<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse;
use App\MaterialDetails;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialDetail extends Model
{
    use SoftDeletes;
    
    public $guarded = [];

    
}