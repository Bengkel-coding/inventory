<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Menu;

class Action extends Model
{
    public $guarded = [];

    public function menus()
    {
        return $this->belongsToMany(Menu::class,'menu_actions')->withPivot('id');
    }

    public function rules($id="")
    {
    	if(!empty($id))
    	{
    		$unique = ',title,'.$id;
    		$unique2 = ',slug,'.$id;
    	}else{
    		$unique = "";
    		$unique2 = "";
    	}

    	return [
    		'title'		=> 'required|unique:actions'.$unique,
    		'slug'		=> 'required|unique:actions'.$unique2,
    	];
    }
}
