<?php namespace App\Http\Controllers\Backend\Warehouse;


 

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Warehouse;
use Table;
use Image;
use trinata;

class WarehouseController extends TrinataController
{
  
    public function __construct(Warehouse $model)
    {
        parent::__construct();
        $this->model = $model;

        $this->resource = "backend.warehouse.daftar.";
    }

    public function getData()
    {
        $model = $this->model->select('id','name','address','phone');

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
        return view($this->resource.'index');
    }

    public function getCreate()
    {
        $model = $this->model;
        return view($this->resource.'_form',compact('model'));
    }

   public function postCreate(Request $request)
    {
        $model = $this->model;

        $inputs = $request->all();
        $inputs['head_office_id'] = \Auth::user()->id;

        $model->create($inputs);

        return redirect(urlBackendAction('index'))->withSuccess('data has been saved');
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
