<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Action;
use App\Models\Menu;
use App\Models\Role;

class MenuAction extends Model
{
    public $guarded = [];

    public function action()
    {
    	return $this->belongsTo(new Action);
    }

    public function menu()
    {
    	return $this->belongsTo(new Menu);
    }

    public function roles()
    {
    	return $this->belongsToMany(new Role,'rights');
    }
}
