<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Material;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialInvestasi extends Model
{
    use SoftDeletes;
    protected $table = 'material_investasis';

    public $guarded = [];

    public function material()
    {
        return $this->belongsTo(Material::class,'material_id');
    }

}