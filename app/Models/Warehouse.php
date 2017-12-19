<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use SoftDeletes;
    protected $table = 'warehouses';

    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'head_office_id');
    }

}