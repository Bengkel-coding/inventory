<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\ExternalLink;

class ImageController extends TrinataController {

	/*
	|--------------------------------------------------------------------------
	| Agenda Pimpinan Controller
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
	public function __construct(ExternalLink $external)
	{
		parent::__construct();
		$this->model = $external;
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return view('vendor.elfinder.ckeditor4');
	}
	// public function getDetail()
	// {
	// 	return view('frontend.eksternal-link._detail');
	// }

}
