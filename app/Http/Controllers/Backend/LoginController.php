<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Mail;

class LoginController extends Controller
{
    public function handleAct($title)
    {
        $userId = getUser()->id;
        
        $action = getUser()->username.' '.$title;
        
        injectModel('UserActivity')->create([
            'user_id'   => $userId,
            'action'    => $action,
        ]);
    }

    public function getIndex()
    {
    	$title = 'Login Area';
    	return view('backend.login',compact('title'));
    }

    public function postIndex(Request $request)
    {
    	$rules = [
    		'username'	=> 'required',
    		'password'	=> 'required',
    	];

    	$this->validate($request,$rules);

    	$credentials = [
    		'username'	=> $request->username,
    		'password'	=> $request->password,
    	];

    	$cek = Auth::attempt($credentials);

    	if($cek)
    	{
            $this->handleAct("Login");
    		return redirect(urlBackend('dashboard/index'));
    	}else{
    		return redirect()->back()->withMessage('User Not Found!');
    	}

    }

    public function getLogout()
    {
        $this->handleAct('Logout');
    	Auth::logout();

    	return redirect('login');
    }

    public function getForgotPassword()
    {
    	$title = 'Forgot Password';
    	return view('backend.forgot',compact('title'));
    }

    public function postForgotPassword(Request $request)
    {
    	$rules = [
    		'email'		=> 'required|email',
    	];

    	$this->validate($request , $rules);

    	$cek = User::whereEmail($request->email)->count();

    	if($cek > 0)
    	{	
    		$new_password = str_random("5").'trinata';
    		
    		$hash = \Hash::make($new_password);

    		$user = User::whereEmail($request->email)->first();

    		Mail::send('backend.emails.forgot' , ['new_password' => $new_password,'model' => $user] , function($m) use ($user){
    			$m->from('no-reply@trinata.com', 'Reset Password');
    			$m->to($user->email);
    		});

    		$user->update([
    			'password' => $hash,
    		]);

    		return redirect()->back()->withSuccess('the new password has been sent to your email');

    	}else{
    		return redirect()->back()->withInput()->withInfo('Email Not Found!');
    	} 
    }
}
