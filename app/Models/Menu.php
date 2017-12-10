<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Action;

class Menu extends Model
{
    public $guarded = [];

    public function actions()
    {
        return $this->belongsToMany(new Action,'menu_actions')->withPivot('id');

    }
    
    public function parent()
    {
    	return $this->belongsTo(new Menu,'parent_id');
    }

    public function childs()
    {
    	return $this->hasMany(new Menu,'parent_id','id');
    }

    public function rules($id="")
    {
    	if(!empty($id))
    	{
    		$unique = ',title,'.$id;
    	}else{
    		$unique = "";
    	}

    	return [
    		'title'		=> 'required|unique:menus'.$unique,
    	];
    }
}
