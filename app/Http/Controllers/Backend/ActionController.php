<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Action;
use Table;

class ActionController extends TrinataController
{
    public function __construct(Action $model)
    {
    	parent::__construct();

    	$this->model = $model;
    }

    public function getData()
    {
    	$model = $this->model->select('id','title','slug');

    	$tables = Table::of($model)

    	->addColumn('action' , function($model){
    		return \trinata::buttons($model->id);
    	})	

    	->make(true);

    	return $tables;
    }

    public function getIndex()
    {
    	return view('backend.action.index');
    }

    public function getCreate()
    {
    	$model = $this->model;

    	return view('backend.action._form',compact('model'));
	}

	public function postCreate(Request $request)
	{
		$this->validate($request,$this->model->rules());

		$this->model->create($request->all());

		return redirect(urlBackendAction('index'))->withSuccess('Data has been saved');
	}

	public function getUpdate($id)
    {
    	$model = $this->model->findOrFail($id);

    	return view('backend.action._form',compact('model'));
	}

	public function postUpdate(Request $request,$id)
	{
		$this->validate($request,$this->model->rules($id));

		$this->model->findOrFail($id)->update($request->all());

		return redirect(urlBackendAction('index'))->withSuccess('Data has been updated');
	}

	public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);

        $model->delete();

        return redirect(urlBackendAction('index'))->withSuccess('Data has been deleted');

    }
}
