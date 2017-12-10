<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\User;
use App\Models\Role;
use Table;
class UserController extends TrinataController
{
	public function __construct(User $model,Role $role)
	{
		$this->model = $model;
		$this->role = $role;
	}

	public function roles()
	{
        return $this->role->lists('role','id');
	}

	public function getData()
	{
		$model = $this->model->select('users.id','name','email','role')
			->join('roles','roles.id','=','users.role_id')->orderBy('users.id');

		$data = Table::of($model)
		
		->addColumn('action' , function($model){
    		return \trinata::buttons($model->id);
    	})

		->make(true);

		return $data;
	}

    public function getIndex()
    {
    	return view('backend.user.index');
    }

    

    public function handleInsert($request)
    {
        
    	$inputs = $request->except(['_token','verify_password']);

        $inputs['password'] = \Hash::make($request->password);
        // unset($inputs['verify_password']);
    	return $inputs;
    }

    public function getCreate()
    {
        $model = $this->model;
        $roles = $this->roles();
        $head = [''] + $this->model->whereType('member')->lists('name','id');
        $division = Division::lists('name','id');

        return view('backend.user._form',compact('model','roles', 'head', 'division'));
    }

    public function postCreate(Request $request)
    {
        // $this->validate($request,$this->model->rules());

        $data = $this->handleInsert($request);
        $user = $this->model->create($data);
        
        if ($user) {
            $inputs['user_id'] = $user->id;
            $inputs['name'] = $request->name;

            MemberProfile::create($inputs);
        }

    	return redirect(urlBackendAction('index'))->withSuccess('Data has been saved');
    }

    public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);
        $roles = $this->roles();
        $head = [''] + $this->model->whereType('member')->lists('name','id');
        $division = Division::lists('name','id');

        return view('backend.user._form',compact('model','roles', 'head', 'division'));
    }

    public function postUpdate(Request $request,$id)
    {
        // if (\Auth::user()->username != 'superadmin') $this->validate($request,$this->model->rules($id));

// \DB::enableQueryLog();
        $data = $this->handleInsert($request);
        $model = $this->model->findOrFail($id)->update($data);
        MemberProfile::whereUserId($id)->update(['name'=>$request->name]);
        // dd(\DB::getQueryLog());
        // dd($this->model->findOrFail($id), $request->all());

        return redirect(urlBackendAction('index'))->withSuccess('Data has been updated');
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);

        $model->delete();

        return redirect(urlBackendAction('index'))->withSuccess('Data has been deleted');

    }
}
