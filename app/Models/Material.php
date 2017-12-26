<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse;
use App\Models\MaterialDetails;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use SoftDeletes;
    protected $table = 'materials';

    public $guarded = [];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id');
    }

    public function details()
    {
    	return $this->hasMany(MaterialDetail::class,'material_id', 'id');
    }

    public function mro()
    {
        return $this->hasOne(\App\Models\MaterialMro::class,'material_id', 'id');
    }

    public function categoryAttribute($value)
    {
        $category = ['tubular' => 'Tubular Good' , 'cock' => 'Cock & Value' , 'fitting' => 'Fitting & Flange' , 'instrument' => 'Instrument' , 'bahankimia' => 'Bahan Kimia / Peralatan' , 'lainlain' => 'Lain-lain'];

        $this->attributes['category'] = $category[$value];
    }

    public function unitAttribute($value)
    {
        $unit = ['buah' => 'Buah', 'liter' => 'Liter' , 'meter' => 'Meter' , 'pieces' => 'Pieces' , 'roll' => 'Roll' , 'unit' => 'Unit'];

        $this->attributes['unit'] = $unit[$value];
    }

    public function unitPriceAttribute($value)
    {
        $this->attributes['unit_price'] = number_format($value);
    }
}