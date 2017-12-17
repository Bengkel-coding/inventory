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
    	return $this->belongsTo(Action::class);
    }

    public function menu()
    {
    	return $this->belongsTo(Menu::class);
    }

    public function roles()
    {
    	return $this->belongsToMany(Role::class,'rights');
    }
}
