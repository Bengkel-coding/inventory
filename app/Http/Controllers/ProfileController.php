<?php 
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use Illuminate\Http\Request;
use App\User;

class ProfileController extends TrinataController {

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
	public function __construct()
	{
		parent::__construct();
		$this->middleware('auth');
		$this->model = new User;
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$user = \Auth::user();
		$model = $this->model->where('id',$user->id)->first();

		return view('frontend.profile.index',compact('user','model'));
	}

	public function getAkun()
	{
		$user = \Auth::user();
		$model = $this->model;

		// dd($user->profile);
		return view('frontend.profile.akun.index',compact('user','model'));

	}

	public function rules()
    {

        return [
	        'password'         => 'required|min:1',
	        'password_confirm' => 'required|same:password' 
        ];
    }
	public function postAkun(Request $request)
	{
	
        $model = $this->model->whereId(\Auth::user()->id);
        $validation = \Validator::make($request->all() , $this->rules());

		if($validation->fails())
        {
            $status = 'failed';
            $bags = $validation->getMessageBag();
            // dd($bags->getMessages());
            $arrayErrors = array_flatten($bags->getMessages());
            $errors = '<ul>';
            foreach($arrayErrors as $key => $val)
            {
                $errors .= "<li>$val</li>";
            }
            $errors .= '</ul>';

            return redirect()->back()->withInfo($errors); 


        }else{
    	// $validator = \Validator::make($request->all(), $rules);

		// $inputs = $request->all();

    	$data['password'] = \Hash::make($request->password);

		$model->update($data);

		$activity = \App\Models\UserActivity::create(['user_id'=>\Auth::user()->id, 'action'=>'update password']);
		
    	return redirect()->back()->withSuccess('Data has been updated');

    	}
	}

	public function postIndex(Request $request)
	{		
        $model = \App\Models\MemberProfile::whereUserId(\Auth::user()->id)->first();
		$inputs = $request->all();
    	
    	// $data['name'] = $inputs['name'];
    	$data['phone_number'] = $inputs['phone'];
    	$data['address'] = $inputs['address'];
    	if(!empty($inputs['cv_file']))
    	{
        	$data['cv_file'] = $this->handleUploadFile($request,$model,'cv_file','frontend/uploads/cv/');
    	}
// dd($data);
		$model->update($data);
        return redirect('profile')->withSuccess('data has been saved');


	}
	

	public function rulesImage()
    {

        return [
	        'photo'         => 'required |image | max:300',
        ];
    }
	public function postImage(Request $request)
	{		
        $model = \App\Models\MemberProfile::whereUserId(\Auth::user()->id);
		$inputs = $request->all();
// dd($inputs);
        $validation = \Validator::make($request->all() , $this->rulesImage());

		if($validation->fails())
        {
            $status = 'failed';
            $bags = $validation->getMessageBag();

            $arrayErrors = array_flatten($bags->getMessages());
            $errors = '<ul>';
            foreach($arrayErrors as $key => $val)
            {
                $errors .= "<li>$val</li>";
            }
            $errors .= '</ul>';

            return redirect()->back()->withInfo($errors); 


        }else{

	        $data['photo'] = $this->handleUploadFile($request,$model,'photo','frontend/uploads/');

			$model->update($data);

	        return redirect('profile')->withSuccess('data has been saved');

	    }
	}
	

}
