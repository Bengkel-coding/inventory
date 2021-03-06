<?php namespace App\Http\Controllers\Backend;


 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use Table;
use Image;
use trinata;

class CrudController extends TrinataController
{
  
    public function __construct(Crud $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

    public function getData()
    {
    	$model = $this->model->select('id','title','status');

    	$data = Table::of($model)
    		->addColumn('action',function($model){
                $status = $model->status == 'y' ? true : false;
    			return trinata::buttons($model->id , [] , $status);
    		})
    		->make(true);

    	return $data;
    }

    public function getIndex()
    {
    	return view('backend.crud.index');
    }

    public function getCreate()
    {
    	$model = $this->model;
        return view('backend.crud._form',compact('model'));
    }

   public function postCreate(Requests\Backend\CrudRequest $request)
    {
        $model = $this->model;
        $inputs = $request->all();
        $inputs['image'] = $this->handleUpload($request,$model,'image',[100,100]);
        return $this->insertOrUpdate($model,$inputs);
    }

    public function getUpdate($id)
    {
        $model = $this->model->findOrFail($id);

        return view('backend.crud._form',compact('model'));
    }

    public function postUpdate(Requests\Backend\CrudRequest $request,$id)
    {
        $model = $this->model->findOrFail($id);
        $inputs = $request->all();
        $inputs['image'] = $this->handleUpload($request,$model,'image',[100,100]);
        return $this->insertOrUpdate($model,$inputs);
    }

    public function getDelete($id)
    {
        $model = $this->model->findOrFail($id);
        return $this->delete($model,[$model->image]);
    }

    public function getPublish($id)
    {
        $model = $this->model->findOrFail($id);
        return $this->publish($model);
    }
}
