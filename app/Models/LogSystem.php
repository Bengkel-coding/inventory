<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogSystem extends Model
{
    use SoftDeletes;
    protected $table = 'log_systems';

    public $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}