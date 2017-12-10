<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		// $this->auth = $auth;
		// $this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	public function postLogin(Request $request)
	{
		$rules = [
    		'email'	=> 'required',
    		'password'	=> 'required',
    	];

		$this->validate($request,$rules);

    	$credentials = [
    		'email'	=> $request->email,
    		'password'	=> $request->password,
    	];

		if (\Auth::attempt($credentials, $request->has('remember'))) {
			$updatePass = \App\Models\UserActivity::whereUserId(\Auth::user()->id)->where('action', 'like', '%update password%')->count();

			if ($updatePass > 0) return redirect()->intended('home');
			else return redirect()->intended('profile/akun');
        }

        return redirect()->back()->withMessage('User Not Found!');
	}	

	public function getLogout()
    {
    	
        \Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}
