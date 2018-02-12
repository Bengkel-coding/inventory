<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Utilization;

use App\Models\ReversionDetail;

use Illuminate\Database\Eloquent\SoftDeletes;

class Reversion extends Model
{
    use SoftDeletes;
    protected $table = 'reversions';

    public $guarded = [];

    public function reversionDetail()
    {
        return $this->hasMany(ReversionDetail::class, 'reversion_id');
    }

}