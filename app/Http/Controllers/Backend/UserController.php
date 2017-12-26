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
        parent::__construct();
		$this->model = $model;
		$this->role = $role;
	}

	public function roles()
	{
		return $this->role->lists('role','id')->toArray();
	}

	public function getData()
	{
		$model = $this->model->select('users.id','name','email','role')
			->join('roles','roles.id','=','users.role_id');

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
    	$inputs = $request->all();

    	$inputs['password'] = \Hash::make($request->password);

    	return $inputs;
    }

    public function getCreate()
    {
        $model = $this->model;
        $roles = $this->roles();
        return view('backend.user._form',compact('model','roles'));
    }

    public function postCreate(Request $request)
    {
    	$this->validate($request,$this->model->rules());

    	$data = $this->handleInsert($request);

    	$this->model->create($data);

    	return redirect(urlBackendAction('index'))->withSuccess('Data has been saved');
    }

    public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);
        $roles = $this->roles();
        return view('backend.user._form',compact('model','roles'));
    }

    public function postUpdate(Request $request,$id)
    {
        $this->validate($request,$this->model->rules($id));

        $data = $this->handleInsert($request);

        $this->model->findOrFail($id)->update($data);

        return redirect(urlBackendAction('index'))->withSuccess('Data has been updated');
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);

        $model->delete();

        return redirect(urlBackendAction('index'))->withSuccess('Data has been deleted');

    }
}
