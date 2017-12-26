<?php namespace App\Http\Controllers\Backend\Pemanfaatan;


 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use Table;
use Image;
use trinata;

class PemanfaatanMroController extends TrinataController
{
  
    public function __construct(Crud $model)
    {
        parent::__construct();
        $this->model = $model;

        $this->resource = "backend.pemanfaatan.mro.";
    }

    public function getData()
    {
        $model = $this->model->select('id','title','status');

        $data = Table::of($model)
            ->addColumn('title',function($model){
                $title = '<input name="title" type="checkbox" class="checklist" data-id="'.$model->id.'" > '.$model->title;


                return $title;

            })
            ->addColumn('action',function($model){
                $status = '<input class="form-control" name="title" type="text" id="amount'.$model->id.'" readonly="readonly"> <input name="title"  class="form-control"  type="text" id="amounts'.$model->id.'" readonly="readonly"> ';
                return $status;
            })
            ->make(true);

        return $data;
    }

    public function getIndex()
    {
        return view($this->resource.'index');
    }


    public function getAjukan()
    {
        return view($this->resource.'ajukan');
    }

    public function getCreate()
    {
        $model = $this->model;
        return view($this->resource.'_form',compact('model'));
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

        return view($this->resource.'_form',compact('model'));
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
