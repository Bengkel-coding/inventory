<?php namespace App\Trinata\Src;

use Illuminate\Support\Facades\Facade;

class TrinataFacade extends Facade
{

	public static function getFacadeAccessor()
	{
		return 'register-trinata';
	}

}