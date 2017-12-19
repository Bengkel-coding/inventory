<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Warehouse;
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

}