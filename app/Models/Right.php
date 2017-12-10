<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MenuAction;
use App\Models\Role;

class Right extends Model
{
    public $guarded = [];

    public function menu_action()
    {
    	return $this->belongsTo(new MenuAction);
    }

    public function role()
    {
    	return $this->belongsTo(new Role);
    }
}
