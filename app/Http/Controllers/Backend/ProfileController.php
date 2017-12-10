<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\User;
use App\Models\Role;
use App\Models\Division;

class ProfileController extends TrinataController
{
    public function __construct(User $model, Role $role)
    {
    	parent::__construct();

    	$this->model = $model->find(getUser()->id);
        $this->role = $role;
    }

    public function roles()
    {
        return $this->role->lists('role','id');
    }

    public function getIndex()
    {
    	$model = $this->model;
        $roles = $this->roles();
        $head = [''] + $this->model->lists('name','id');
        $division = Division::lists('name','id');

    	return view('backend.profile.index',compact('model', 'head', 'division', 'roles'));
    }

    public function handleInsert($request)
    {
    	$inputs = $request->all();

        if ($request->password) {
            $inputs['password'] = \Hash::make($request->password);  
        } else {
            unset($inputs['password']);
        }
    	$inputs['role_id'] = $this->model->role_id;
    	return $inputs;
    }

    public function postIndex(Request $request)
    {
    	$model = new User;

        if (\Auth::user()->role_id != 1) $this->validate($request, $model->rules($this->model->id));

    	$data = $this->handleInsert($request);
        // dd($data);
    	$this->model->update($data);

    	return redirect(urlBackendAction('index'))->withSuccess('Data has been updated');
    }
}
