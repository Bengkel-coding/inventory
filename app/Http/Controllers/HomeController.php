<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\TrinataController;
use App\Http\Requests;
use Trinata;


class HomeController extends TrinataController {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->middleware('auth');
		// dd(\Auth::user());
		

	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		
	}

}
