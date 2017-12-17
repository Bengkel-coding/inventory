<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\MenuAction;

class Role extends Model
{
    public $guarded = [];

    public function rules($id="")
    {
    	if(!empty($id))
    	{
    		$unique = ',role,'.$id;
    	}else{
    		$unique = "";
    	}

    	return [
    		'role'		=> 'required|unique:roles'.$unique,
    	];
    }

    public function user()
    {
    	return $this->belongsTo(User::class,'role_id');
    }

    public function menu_actions()
    {
        return $this->belongsToMany(MenuAction::class , 'rights')->withPivot('id');
    }
}
