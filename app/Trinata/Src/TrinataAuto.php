<?php

function trinata()
{
	return new App\Trinata\Src\Trinata;
}

function arrayMenuRole($data){

    $result=array();
    $i=0;

    foreach ($data as $key => $value) {

        if(!in_array($value->menu_action->menu_id, $result)){

            $result[$i]=$value->menu_action->menu_id;
            $i++;

        }
        
    }

    return $result;
}

function arrayParentMenuRole($data){

    $result=array();
    $i=0;

    foreach ($data as $key => $value) {
    	if(!empty($value->menu_action->menu->parent->id)){
	        if(!in_array($value->menu_action->menu->parent->id, $result)){

	            $result[$i]=$value->menu_action->menu->parent->id;
	            $i++;

	        }	
    	}
        
    }
    $result[$i] = 1;
    return $result;
}
function injectModel($model)
{
	$inject = "App\Models\\".$model;
	return new $inject;
}

function urlBackend($slug)
{
	return url(trinata()->backendUrl.'/'.$slug);
}

function urlBackendAction($action)
{
	return urlBackend(request()->segment(2).'/'.$action);
}

function getUser()
{
	return Auth::user();
}

function randomImage($str = "")
{
	return str_random(6).date("YmdHis");
}

function searchMenu($eachId,$return,$else="",$status=""){
        $menu = trinata::getMenu();

        if($status == 'child')
        {
            $id = $menu->id;

        }else{
            if($menu->parent_id != null)
            {
                $id =  $menu->parent_id;
            }else{
                $id = $menu->id;
            }
        }
               

        return $eachId == $id ? $return : $else;
    };
