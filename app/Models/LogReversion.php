<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Utilization;

use App\Models\ReversionDetail;

use Illuminate\Database\Eloquent\SoftDeletes;

class LogReversion extends Model
{
    use SoftDeletes;
    protected $table = 'log_reversions';

    public $guarded = [];

    public function reversionDetail()
    {
        return $this->hasMany(ReversionDetail::class, 'reversion_id');
    }

}