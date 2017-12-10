<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	public function apiResponse($inputs=array())
    {
        if (isset($inputs['status'])) $status = $inputs['status'];
        else $status = FALSE;
        
        if (isset($inputs['data'])) $data = $inputs['data'];
        else $data = NULL;
        
        if (isset($inputs['auth'])) $auth = $inputs['auth'];
        else $auth = NULL;
        
        if (isset($inputs['message'])) $message = $inputs['message'];
        else $message = NULL;
        
        return array('status' => $status, 'data' => $data, 'auth' => $auth, 'message' => $message);
    }
}
