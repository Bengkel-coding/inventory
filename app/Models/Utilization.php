<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Material;
use App\Models\UtilizationDetail;
use App\Models\Warehouse;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Utilization extends Model
{
    use SoftDeletes;
    protected $table = 'utilizations';

    public $guarded = [];

    public function material()
    {
        return $this->belongsTo(Material::class,'material_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function utilizationDetail()
    {
        return $this->hasMany(UtilizationDetail::class, 'utilization_id');
    }
}