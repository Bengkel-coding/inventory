<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Warehouse;
use App\Models\MaterialDetails;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materialdata extends Model
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
    	return $this->hasMany(MaterialDetails::class,'material_id', 'id');
    }

}