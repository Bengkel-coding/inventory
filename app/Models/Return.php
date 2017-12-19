<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Utilization;
use Illuminate\Database\Eloquent\SoftDeletes;

class Return extends Model
{
    use SoftDeletes;
    protected $table = 'returns';

    public $guarded = [];

    public function utilization()
    {
        return $this->belongsTo(Material::class,'utilization_id');
    }

}