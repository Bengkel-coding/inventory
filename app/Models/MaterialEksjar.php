<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Material;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialEksjar extends Model
{
    use SoftDeletes;
    protected $table = 'material_eksjars';

    public $guarded = [];

    public function material()
    {
        return $this->belongsTo(Material::class,'material_id');
    }

}