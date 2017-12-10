<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Role;
use App\Models\Right;
use Table;
use DB;

class RoleController extends TrinataController
{
    public function __construct(Role $model , Right $right)
    {
    	parent::__construct();

    	$this->model = $model;

    	$this->right = $right;
    }

    public function getData()
    {
    	$model = $this->model->select('id','role');

    	$tables = Table::of($model)

    	->addColumn('action' , function($model){
    		return \trinata::buttons($model->id);
    	})	

    	->make(true);

    	return $tables;
    }

    public function getIndex()
    {
    	return view('backend.role.index');
    }

    public function getCreate()
    {
    	$model = $this->model;

    	return view('backend.role._form',compact('model'));
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

    	return view('backend.role._form',compact('model'));
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

    public function getView($id)
    {
    	$model = $this->model->findOrFail($id);
    	$menu = injectModel('Menu');
    	return view('backend.role.view',compact('model','menu'));
    }

    public function postView(Request $request , $id)
    {
    	$model = $this->model->findOrFail($id);

    	$count = count($request->menu_action_id);

    	DB::beginTransaction();

    	try
    	{

    		$this->right->whereRoleId($model->id)->delete();

    		for($a=0;$a<$count;$a++)
    		{
    			$this->right->create([
    				'role_id'			=> $model->id,
    				'menu_action_id'	=> $request->menu_action_id[$a],
    			]);
    		}

    		DB::commit();
    		
    		return redirect(urlBackendAction('index'))->withSuccess('Data has been updated');
    	
    	}catch(\Exception $e){

    		DB::rollback();
    	
    		return redirect(urlBackendAction('index'))->withInfo('Transaction Failed : '.$e->getMessage());
    	}
    }
}
