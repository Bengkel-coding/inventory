<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Material;
use App\Models\LogMaterial;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogMaterialInvestasi extends Model
{
    use SoftDeletes;
    protected $table = 'log_material_investasis';

    public $guarded = [];

    public function material()
    {
        return $this->belongsTo(Material::class,'material_id');
    }

}