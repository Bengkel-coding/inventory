<?php

function trinata()
{
	return new App\Trinata\Src\Trinata;
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
	return urlBackend(\Request::segment(2).'/'.$action);
}

function getUser()
{
	return Auth::user();
}

function randomImage($str = "")
{
	return str_random(6).date("YmdHis");
}

function checkActive($permalink=false,$segment=1,$class="active")
{	
	if($permalink){
		if(\Request::segment($segment)==$permalink){
			echo $class;
		}else{
			echo "";
		}		
	}else{
		echo "";
	}
}