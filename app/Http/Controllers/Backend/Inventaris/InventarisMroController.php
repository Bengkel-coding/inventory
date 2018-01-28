<?php namespace App\Http\Controllers\Backend\Inventaris;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Backend\TrinataController;
use App\Models\Crud;
use App\Models\Material;
use App\Models\MaterialMro;
use App\Models\Assessment;
use App\Models\Warehouse;
use Table;
use Image;
use trinata;

class InventarisMroController extends TrinataController
{
  
    public function __construct(Material $model)
    {
        parent::__construct();
        $this->model = $model;

        $this->resource = "backend.inventaris.mro.";
    }

    public function getData(Request $request)
    {
        // $model = $this->model->select('id','name','komag','category', 'year_acquisition','amount','unit_price','unit')->orderBy('created_at','desc')->whereStatus(0)->whereType('mro');

        $model = $this->model
                        ->select('id','name','komag','description','category',\DB::raw('sum(amount - total_proposed_amount) as amount'),'unit')
                        ->groupBy('komag')
                        ->where('warehouse_id', '=', \Auth::User()->warehouse_id)
                        // ->orderBy('created_at','desc')
                        ->whereType('mro');

        $data = Table::of($model)
            ->addColumn('action',function($model){
                $button = "<a href='".urlBackendAction('detail/'.$model->id)."' class='btn btn-info'>Ajukan</a>";
                return $button;
            })
            ->make(true);

        return $data;
    }

    public function getIndex(Request $request)
    {
        $model = $this->model;
        return view($this->resource.'index', compact('model', 'request'));
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
